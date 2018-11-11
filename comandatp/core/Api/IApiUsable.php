<?php
namespace Core\Api;

abstract class IApiUsable{
	
    public function getParams($request)
    {
        return   $request->getParsedBody();
    }

    public function getParam($request,$param,$defaultValue = null)
    {
        $body = $request->getParsedBody();
        if(!isset($body[$param])){
           return ($defaultValue) ?  $defaultValue: null;
        }
        return $body[$param];
    }

   	abstract public function TraerUno($request, $response, $args);
    abstract public function TraerTodos($request, $response, $args);
    abstract public function CargarUno($request, $response, $args);
    abstract public function BorrarUno($request, $response, $args);
    abstract public function ModificarUno($request, $response, $args);

}