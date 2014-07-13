<?php

namespace Exphpress;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The Exphpress application, our main
 * interface to the world :)
 */
class App
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;
    
    /**
     * @var \Symfony\Component\HttpFoundation\Response
     */
    protected $response;
    
    /**
     * Constructor that simply sets req/res in internal
     * members.
     * 
     * @param Symfony\Component\HttpFoundation\Request $req
     * @param Symfony\Component\HttpFoundation\Response $res
     */
    public function __construct(Request $req, Response $res)
    {
        $this->request  = $req;
        $this->response = $res;
    }
    
    /**
     * Execute the $callback once a request hits the app.
     * 
     * Calling listen will effectively terminate the request's
     * lifecycle, as it will start the process of sending the
     * response to the client.
     * 
     * @param Closure $callback
     */
    public function listen(\Closure $callback = null)
    {
        if ($callback) {
            $callback($this->request, $this->response);
        }
        
        return $this->response->send();
    }
}