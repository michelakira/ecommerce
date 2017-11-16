<?php

use Oeste\Page;
use Oeste\Model\Product;

$app->get('/', function() {
    
    $products = Product::listAll();
    
    
    $page = new Page();

    $page->setTpl("index",[
        'products'=> Product::checkList($products)
    ]);
        
});



?>