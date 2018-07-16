<?php

//
//if (isset($_POST['input'])){
//    
//    
//    
//    //Get Product list
//    
//    if ($_POST['input'] === 'products'){
//        $html_text = '';        
//        $link = connectDB();
//        
//        $res = $link->query("SELECT * FROM product");
//        while($row = $res->fetch_assoc()){
//            $html_text.= '<option value='.$row['tree_prod_id'].'>'.$row['tree_prod_name'].'</option>';
//        }
//        
//        $link->close();
//        if ($html_text !== ''){
//           echo $html_text; 
//        }
//        else {
//            echo -1;
//        }
//    }//CATEGORIES    
//    
//}//CATEGORIES