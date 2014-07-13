# Exphpress

[![Build Status](https://travis-ci.org/odino/exphpress.png?branch=master)](https://travis-ci.org/odino/exphpress)

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

Matching a GET request is quite simple:

``` php
<?php

$app = Exphpress\app();

$app->get("/call-me-maybe/{name}", function($req, $res){
    $res->setContent("Hey, I just matched you, and this is crazy...");
});
```

The above route will be matched when we issue a `GET` request to our
webserver that matches the path `/call-me-maybe/{name}`.

The same can be done for post and all other [HTTP methods](https://github.com/odino/exphpress/blob/master/src/App.php#L52-L76).

## Write your own middleware

Middlewares play a big part in a microframework's architecture:

``` php
$app->uses(function($req, $res, $next){
    if ($todayIsABadDay) {
        $res->setStatusCode(403);
        $res->setContent(null);
    } else {
        $next();
    }
});
```

As you probably understood, the `$next` is a callback that invokes
the following middleware, which means that you concatenate them at
will (ie. look at [this test](https://github.com/odino/exphpress/blob/6e92cc453185199d2a878ae146b83c395e4bc19c/spec/Exphpress/AppSpec.php#L113-L138)).

## Installation

Exphpress is available through [composer](https://packagist.org/packages/odino/exphpress)
(how else?!?!).

## Tests

They run on travis through phpspec: if you want to contribute or
hack around exphpress simply clone this repository and check into
greenland with a:

```
./vendor/bin/phpspec run
```

## License

For those who care, exphpress is release under the MIT license.

## The hell, why?

There's [Silex](http://silex.sensiolabs.org/), I know, but
I couldn't resist.