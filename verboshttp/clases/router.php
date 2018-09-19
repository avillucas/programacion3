<?php 
class Router
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
        $p = array_slice($p,URI_PART);        
        $c = count($p);                
        if($this->method == 'DELETE' || $this->method == 'PUT' ) 
        {
            $this->class = $p[$c-2];                    
            $this->setRequestedId($p[$c-1]);
        }
        elseif($this->method == 'GET' && is_numeric($p[$c-1]))
        {
            $this->class = $p[$c-2];                    
            $this->requestedId = intval($p[$c-1]);                    
        }
        else
        {
            if(!isset($p[$c-1])){
                throw new \Exception("Entidad no enviada", 1);                
            }
            $this->class = $p[$c-1];                                             
            if(!class_exists($this->class))
            {
                throw new \Exception("La clase ".$this->class." no existe", 1);            
            }
        }
        
    }

    public function setRequestedId($nro)
    {
        if(!is_numeric($nro)){
            throw new \Exception("El id del elemento no esta presente", 1);                
        }
        $this->requestedId = intval($nro);        
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

    public function getClass()
    {
        return $this->class;
    }

     private static function headerStatus($statusCode ) {                
        $statusCodes = array (
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-Status',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            426 => 'Upgrade Required',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates',
            507 => 'Insufficient Storage',
            509 => 'Bandwidth Limit Exceeded',
            510 => 'Not Extended'
        );        
        if (isset($statusCodes[$statusCode])) {     
            $statusString  = $statusCodes[$statusCode];
            header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusString, true, $statusCode);
        }
    }

    public static function sendResponse($msjArray,$status=200)
    {
        self::headerStatus($status);
        die(json_encode($msjArray, true));
    }
}