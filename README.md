# Exphpress

> The missing, elegant, productive microframework for
> PHP, inspired by ExpressJS.
>
> Because PHP is cool too.

## Example

The very least you need:

``` php
<?php

require __DIR__ . '/../vendor/autoload.php';

$app = Exphpress\app();

$app->listen(function($req, $res){
    $date = new \DateTime();
    
    $res->setContent("Today is " . $date->format('l, jS \o\f F Y'));
    
    return $res;
});
```

This will return, for every request, something like
`Today is Sunday, 13th of July 2014,`; if you want to see it in action
clone this repository and run `php -S localhost:4000 examples/simple.php`.

## Installation

## Getting fancy

## Write your own middleware

## License

## The hell, why?

There's [Silex](http://silex.sensiolabs.org/), I know, but
I couldn't resist.