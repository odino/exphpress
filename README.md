# Exphpress

> The missing, elegant, productive microframework for
> PHP, inspired by ExpressJS.
>
> Because PHP is cool too.

## Example

The very least you need:

``` php
<?php

$app = Exphpress\app();

$app->listen(function($req, $res){
    $date = new \DateTime();
    
    $res->setContent("Today is " . $date->format('l, jS \o\f F Y'));
});
```

This will return, for every request, something like
`Today is Sunday, 13th of July 2014,`; if you want to see it in action
clone this repository and run `php -S localhost:4000 examples/simple.php`.

## Getting fancy

## Write your own middleware

## Installation

Exphpress is available through [composer](https://packagist.org/packages/odino/exphpress)
(how else?!?!).

## Tests

They run on travis through phpspec: if you want to contribute or
hack around exphpress simply clone this repository and check into
greenland with a:

```
TBD
```

## License

For those who care, exphpress is release under the MIT license.

## The hell, why?

There's [Silex](http://silex.sensiolabs.org/), I know, but
I couldn't resist.