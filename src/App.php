<?php

namespace Exphpress;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * The Exphpress application, our main
 * interface to the world :)
 */
class App
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    public $request;
    
    /**
     * @var \Symfony\Component\HttpFoundation\Response
     */
    public $response;
    
    /**
     * A stack of actions / routes  / middlewares registered
     * on the current app.
     */
    protected $stack = array();
    
    /**
     * Constructor that simply sets req/res in internal
     * members.
     * 
     * @param Symfony\Component\HttpFoundation\Request $req
     * @param Symfony\Component\HttpFoundation\Response $res
     */
    public function __construct(Request $req = null, Response $res = null)
    {
        $this->request      = $req ?: Request::createFromGlobals();
        $this->response     = $res ?: new Response();
    }
    
    public function get($path, \Closure $callback)
    {
        $routes             = new RouteCollection();
        $route              = new Route(
            $path, 
            array(), 
            array(), 
            array(), 
            null, 
            array(), 
            array('GET')
        );
        $routes->add('GET_' . $path, $route);
        
        $context            = new RequestContext();
        $context->fromRequest($this->request);
        
        $matcher   = new UrlMatcher($routes, $context);
        
        $this->stack[] = function(Request $req, Response $res, \Closure $next) use ($matcher, $path, $callback){
            try {
                if ($matcher->match($req->getPathInfo())) {
                    $res->setStatusCode(Response::HTTP_OK);
                    $callback($req, $res, $next);
                }
            } catch (ResourceNotFoundException $e) {
                $res->setStatusCode(Response::HTTP_NOT_FOUND);
                $next();
            }
        };
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
            $this->stack[] = $callback;
        }
        
        $this->process();
        
        return $this->response->send();
    }
    
    /**
     * Registers a middleware.
     * 
     * @param Closure $callback
     */
    public function uses(\Closure $callback)
    {
        if ($callback) {
            $this->stack[] = $callback;
        }
    }
    
    /**
     * Processes the request the current app's been
     * sent through, by looping through the stack of
     * middlewares and producing a response.
     */
    protected function process()
    {
        if (count($this->stack)) {
            $callback   = array_shift($this->stack);
            $app        = $this;
            
            $callback->__invoke($this->request, $this->response, function() use ($app) {
                return $app->process();
            });
        }
    }
}












