<?php

// Get Products list
function getProducts() {
    $arrProducts = [];
    $link = connectDB();
    $res = $link->query("SELECT id, prod_name FROM products");
    while ($row = $res->fetch_assoc()) {
        $arrProducts[] = $row;
    }//while    
    $link->close();
    return $arrProducts;
}//getProducts()



function getProductInformation() {
    $current_price = '';
    
     //Set default price
    if(isset($_POST['submit_default_price'])){
       $default_price = $_POST['default_price'];    
       $product_id = $_POST['product_id']; 
       $link = connectDB();
       $res = $link->query("UPDATE products SET default_price=$default_price WHERE id=$product_id ");
       $link->close;
    }//Set default price
    
    
     //Set price definition
    if(isset($_POST['submit_price_definition'])){
       $price_definition_method = $_POST['price_definition_method'];    
       $product_id = $_POST['product_id']; 
       $link = connectDB();
       $link->query("UPDATE products SET price_definition=$price_definition_method WHERE id=$product_id ");
       $link->close;
    }//Set price definition
    
    
    //Create new interval
    if (isset($_POST['submit_new_interval'])) {
        $product_id = $_POST['product_id'];
        $interval_start = date("Y-m-d", strtotime($_POST['interval_start']));
        
        if ($_POST['interval_end'] != ""){
            $interval_end = date("Y-m-d", strtotime($_POST['interval_end'])); 
        }
        else {
            $interval_end = "9999-12-31";
        }
               
        $interval_price = $_POST['interval_price'];
        $link = connectDB();
        $link->query("INSERT INTO interval_price SET "
                . "prod_id=$product_id,"
                . "interval_start='$interval_start',"
                . "interval_end='$interval_end',"
                . "interval_price=$interval_price");
        $link->close;
        
    }//Create new interval
    
    
    //Delete interval
    if (isset($_POST['submit_del_interval'])) {
        $interval_id = $_POST['interval_id'];
       
        $link = connectDB();
        $link->query("DELETE FROM interval_price WHERE interval_id=$interval_id");
        $link->close;
        
    }//Delete interval
    
    
   
    
    // Get Product information
    if (isset($_POST['product_id'])) {
        $arrProductInformation = [];        
        $product_id = $_POST['product_id'];        
        $link = connectDB();
        $res = $link->query("SELECT * FROM "
                . "products p LEFT JOIN interval_price ip "
                . "ON p.id=ip.prod_id "
                . "WHERE p.id=$product_id "
                . "ORDER BY ip.interval_id DESC");  
                
        while ($row = $res->fetch_assoc()){
            $arrProductInformation['id'] = $row['id'];
            $arrProductInformation['prod_name'] = $row['prod_name'];
            $arrProductInformation['prod_img'] = $row['prod_img'];
            $arrProductInformation['price_definition'] = $row['price_definition'];
            $arrProductInformation['default_price'] = $row['default_price'];
            if (isset($row['interval_id'])){
                $arrProductInformation['intervals'][$row['interval_id']] = $row;
            }
            
        }
        $link->close(); 
         
        return $arrProductInformation;
    }// Get Product information
    
        
}//


//Check price on date
function checkPriceOnDate(){
    $checkPriceOnDate = [];
    
    if (isset($_POST['submit_check_price'])) {
        $product_id = $_POST['product_id'];
        $price_definition = $_POST['price_definition'];
        $check_price_date = $_POST['check_price_date'];
               
        $link = connectDB();
        $query = '';
        if (!$price_definition) {
            $query = "  SELECT * FROM (SELECT 
                        interval_id, 
                        prod_id, 
                        interval_start, 
                        interval_end, 
                        interval_price, 
                        (TO_DAYS(interval_end)-TO_DAYS(interval_start)) delta
                        FROM interval_price 
                        WHERE prod_id=$product_id AND (`interval_start` <= '$check_price_date' AND `interval_end` >= '$check_price_date')
                            ) sel
                        ORDER BY sel.delta
                        LIMIT 1";
        } else {
            $query ="   SELECT * 
                        FROM interval_price 
                        WHERE prod_id=$product_id  AND (`interval_start` <= '$check_price_date' AND `interval_end` >= '$check_price_date')
                        ORDER BY interval_id DESC
                        LIMIT 1";
        }

        $res = $link->query($query);      
        if ($res->num_rows !== 0){
            $res = $res->fetch_assoc();
            $current_price = $res['interval_price'];            
        }       
        else {            
            $temp = $link->query("SELECT * FROM products WHERE id=$product_id LIMIT 1");
            $temp = $temp->fetch_assoc();
            $current_price = $temp['default_price'];
        }
             
        $link->close;   
        $checkPriceOnDate['current_price'] = $current_price;
        $checkPriceOnDate['check_price_date'] = $check_price_date;
        
        return $checkPriceOnDate;
    }
}//Check price on date 


