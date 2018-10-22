<?php 
class Router
{
    /** */
    public static function getOpcion()
    {
        if( !isset($_GET['opcion'])) throw new Exception('la opcion no fue definida');
        return  $_GET['opcion'];
    }

    public static function getPostParam($param)
    {
        if( !isset($_POST[$param])) throw new Exception('El parametro $param no existe en POST');
        return $_POST[$param];
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
            header( $statusString, true, $statusCode);

        }
    }

    public static function sendJsonParamResponse($data,$params, $status=200)
    {
        $out = [];
        if($data instanceof IEntidad)
        {
            $data = $data->__toArray();
        }
        foreach($params as $param)
        {
            $out[$param] = $data[$param];
        }
        return Router::sendJsonResponse($out,$status);
    }

    public static function sendJsonResponse($data,$status=200)
    {
        self::headerStatus($status);
        header('Content-Type: application/json');
        if($data instanceof IEntidad)
        {
         die($data->__toJson());
        }
        else
        {
         die(json_encode($data, true));
        }
    }

}