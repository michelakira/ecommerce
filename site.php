<?php

use Oeste\Page;
use Oeste\Model\Product;
use Oeste\Model\Category;
use Oeste\Model\Cart;

$app->get('/', function() {
    
    $products = Product::listAll();
    
    
    $page = new Page();

    $page->setTpl("index",[
        'products'=> Product::checkList($products)
    ]);
        
});

$app->get("/categories/:idcategory", function ($idcategory){

    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
    
    $category = new Category();
    
    $category->get((int)$idcategory);
    
    $pagitation = $category->getProductsPage($page);

    $pages = [];
    
    for ($i = 1; $i <= $pagitation['pages']; $i++) {
        array_push($pages, [
           'link'=> '/categories/'.$category->getidcategory().'?page='.$i,
           'page'=>$i
        ]);
    }
    
    $page = new Page();
    
    $page->setTpl("category",[
        'category'=>$category->getValues(),
        'products'=> $pagitation["data"],
        'pages'=>$pages
    ]);
    
});

$app->get("/products/:desurl", function ($desurl){

    $product = new Product();
    
    $product->getFromURL($desurl);
    
    $page = new Page();
    
    $page->setTpl("product-detail", [
       'product'=> $product->getValues(),
       'categories'=>$product->getCategories()
    ]);
    
});


$app->get('/cart', function (){
    
    $cart = Cart::getFromSession();

    $page = new Page();
    
    $page->setTpl("cart");
    
});


?>