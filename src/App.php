<?php

namespace Exphpress;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class App
{
    protected $request;
    protected $response;
    
    public function __construct(Request $req, Response $res)
    {
        $this->request  = $req;
        $this->response = $res;
    }
    
    public function listen(\Closure $callback = null)
    {
        if ($callback) {
            $callback($this->request, $this->response);
        }
        
        return $this->response->send();
    }
}