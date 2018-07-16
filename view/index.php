<?php
defined('TESTFORRGRANT') or die('Access Denied');
//debug($arrProductInformation);
//debug($checkPriceOnDate);
//debug ($_POST);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link href="<?= VIEW ?>css/bootstrap.css" rel="stylesheet">           
        <link href="<?= VIEW ?>css/style.css" rel="stylesheet">

        <!--<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="<?= VIEW ?>js/bootstrap.js"></script>
        
        
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
        

    </head>
    <body>

        <div class="distance"></div>


        <div class="container">
            <form method="post" action="">
                <label>

                    <select class="form-control" name="product_id" required >
                        <option value="">--Выбор товара--</option>
                        <?php foreach ($arrProducts as $product) : ?>                        
                            <option value="<?= $product['id'] ?>"><?= $product['prod_name'] ?></option>                        
                        <?php endforeach; ?>
                    </select>
                </label>
                <input class="btn btn-sm btn-success" type="submit" name="submit_product" value="Выбрать">
            </form>
        </div>

        <hr>
        
        
        <?php if(isset($arrProductInformation)):?>
        
        <div class="row">

            <!--Products-->
            <div class="col-md-4 text-center ">      

                <div class="text-center item">
                    <img src="<?= VIEW ?>images/<?=$arrProductInformation['prod_img']?>"> 

                    <p><?=$arrProductInformation['prod_name']?></p>
                </div>

                <br><br>
                <form method="post" action="">
                    <label>Проверить цену на дату:
                        <input type="date" name="check_price_date" value="<?=$checkPriceOnDate['check_price_date']?>" >
                    </label>
                    <input type="hidden" name="product_id" value="<?=$arrProductInformation['id']?>">
                    <input type="hidden" name="price_definition" value="<?=$arrProductInformation['price_definition']?>">
                    <input class="btn btn-sm btn-success" name="submit_check_price" type="submit" value="Ok">
                </form>
                <label>Цена на выбранную дату: <?=$checkPriceOnDate['current_price']?> грн </label>

            </div>




            <!--Prices and intervals-->
            <div class="col-md-8 text-left">

                <div class="row">
                    <div class="col-md-4 text-left">
                        <form method="post" action="">
                            <h3>Цена по умолчанию </h3>
                            <input type="hidden" name="product_id" value="<?=$arrProductInformation['id']?>">
                            <input type="text" name="default_price" value="<?=$arrProductInformation['default_price']?>">
                            грн 
                            <input class="btn btn-sm btn-success" type="submit" name="submit_default_price" value="Ok">
                        </form>
                    </div>
                    <div class="col-md-4 text-left">
                        <form method="post" action="">
                            <h3>Способ определения цены</h3>                            

                            <input type="hidden" name="product_id" value="<?=$arrProductInformation['id']?>">
                            <?php if (!$arrProductInformation['price_definition']): ?>                            
                                <input checked type="radio" id="Choice1" name="price_definition_method" value="0">
                                <label for="Choice1">Приоритетнее цена с меньшим периодом действия </label>
                                <br>
                                <input type="radio" id="Choice2" name="price_definition_method" value="1">
                                <label for="Choice2">Приоритетнее цена, установленная позднее </label>
                            <?php else: ?>
                                <input  type="radio" id="Choice1" name="price_definition_method" value="0">
                                <label for="Choice1">Приоритетнее цена с меньшим периодом действия </label>
                                <br>
                                <input checked type="radio" id="Choice2" name="price_definition_method" value="1">
                                <label for="Choice2">Приоритетнее цена, установленная позднее </label>                            
                            <?php endif; ?>

                                <input class="btn btn-sm btn-success" type="submit" name="submit_price_definition" value="Сохарнить">    
                        </form>
                    </div>
                </div>

                <hr>

                <form method="post" action="">
                    <input type="hidden" name="product_id" value="<?=$arrProductInformation['id']?>">
                    <h3>Сезонные цены</h3>
                    Добавить интервал: 
                    с 
                    <input type="date" name="interval_start" value="" > 
                    по 
                    <input type="date" name="interval_end" value="" >
                    - цена   
                    <input type="text" name="interval_price" value="" >
                    грн.
                    <input class="btn btn-sm btn-success" type="submit" name="submit_new_interval" value="Сохранить">
                </form>
                <br><br>
                
                    <?php if (isset($arrProductInformation['intervals'])):?>                    
                    <?php foreach ($arrProductInformation['intervals'] as $interval_id => $interval): ?>
                        <form method="post" action="">
                            <p>	
                                <input type="hidden" name="product_id" value="<?=$arrProductInformation['id']?>">
                                <input type="hidden" name="interval_id" value="<?= $interval_id ?>">
                                <input class="btn btn-sm btn-danger" type="submit" name="submit_del_interval" value="-">
                                В период с 
                                <b><?= date("d.m.Y.",strtotime($interval['interval_start']))?></b> 
                                
                                <?php if($interval['interval_end']!='9999-12-31'):?>
                                    по 
                                    <b><?=date("d.m.Y",strtotime($interval['interval_end']))?></b> 
                                <?php endif;?>
                                действует цена 
                                <b><?= $interval['interval_price'] ?></b> 
                                грн 

                            </p>
                        </form>
                    <?php endforeach; ?>
                    <?php endif;?>
                    

            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 text-left">
                <p>Графики</p>
                <div id="curve_chart"  style="width: 1200px; height: 500px"></div>
            </div>
            
            
        </div>
        
        
        <?php endif;?>

        <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Year', 'Sales', 'Expenses'],
              ['01/01/2016',  8000,      400],
              ['01/02/2016',  1000,      400]
              
              
            ]);

            var options = {
              title: 'Charts',
              curveType: 'function',
              legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
          }
        </script>

    </body>


</html>


