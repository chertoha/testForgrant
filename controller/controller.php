<?php
defined ('TESTFORRGRANT') or die('Access Denied');

// Model
require_once MODEL;


$arrProducts = getProducts();
$checkPriceOnDate = checkPriceOnDate();
$arrProductInformation = getProductInformation();


require_once VIEW.'index.php';