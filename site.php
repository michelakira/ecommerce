<?php

use Oeste\Page;

$app->get('/', function() {
    
	$page = new Page();
        
        $page->setTpl("index");
        
});



?>