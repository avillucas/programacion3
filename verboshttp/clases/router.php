<?php 
class Router($server)
{
    private $method ;    
    private $requestedId;    
    private $class;    

    public function __construct(array $server)
    {

        // Método de petición empleado para acceder a la página, es decir 'GET', 'HEAD', 'POST', 'PUT'.
        $this->method  = $server['REQUEST_METHOD'];
        $this->requestedId = null;
        $this->parseUri($server['REQUEST_URI']);
    }

    private function parseUri($uri)
    {        
        $p = explode('/',$uri);
        $class = explode('/',$uri);
        $ind =  end($p);
        if(is_numeric($ind))
        {
            $this->requestedId =  intval($ind);            
        }
        else
        {

        }
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getRequestedId()
    {
        return $this->requestedId;
    }

    public function hasRequestedId()
    {
        return (!empty($this->requestedId));
    }

}