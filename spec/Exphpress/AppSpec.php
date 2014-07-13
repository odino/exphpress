<?php

namespace spec\Exphpress;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Exphpress\App');
    }    
    
    function it_builds_default_objects_when_initialized_without_dependencies()
    {
        $this->request->shouldHaveType('Symfony\Component\HttpFoundation\Request');
        $this->response->shouldHaveType('Symfony\Component\HttpFoundation\Response');
    }
    
    function it_is_initializable_by_injecting_objects(Request $req, Response $res)
    {
        $this->beConstructedWith($req, $res);
        $this->shouldHaveType('Exphpress\App');
    }
}
