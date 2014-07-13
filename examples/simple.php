<?php

require __DIR__ . '/../vendor/autoload.php';

$app = Exphpress\app();

$app->listen(function($req, $res){
    $date = new \DateTime();
    
    $res->setContent("Today is " . $date->format('l, jS \o\f F Y'));
    
    return $res;
});