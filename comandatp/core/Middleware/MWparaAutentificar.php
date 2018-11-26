<?php
namespace Core\Middleware;

use Core\Exceptions\SysValidationException;

class MWparaAutentificar
{
 /**
   * @api {any} /MWparaAutenticar/  Verificar Usuario
   * @apiVersion 0.1.0
   * @apiName VerificarUsuario
   * @apiGroup MIDDLEWARE
   * @apiDescription  Por medio de este MiddleWare verifico las credeciales antes de ingresar al correspondiente metodo 
   *
   * @apiParam {ServerRequestInterface} request  El objeto REQUEST.
   * @apiParam {ResponseInterface} response El objeto RESPONSE.
   * @apiParam {Callable} next  The next middleware callable.
   *
   * @apiExample Como usarlo:
   *    ->add(\MWparaAutenticar::class . ':VerificarUsuario')
   */
    private function verificarBarearTokenOrFail($request)
    {
        try
        {
            $token =  AutentificadorJWT::verificarBarearToken($request);
        }
        catch (\Exception $e)
        {
            throw new SysValidationException("El token es invalido",null,$e);
        }
        return $token;
    }

	public function verificarUsuario($request, $response, $next)
    {
       $token= $this->verificarBarearTokenOrFail($request);
        return $next($request, $response);
	}

    public function verificarSocio($request, $response, $next)
    {
        $token= $this->verificarBarearTokenOrFail($request);
        $userData = AutentificadorJWT::obtenerData($token);
        if(!$userData->isSocio)
        {
            throw new SysValidationException("Debe ser un socio para ingresar a esta funcionalidad");
        }
        return $next($request, $response);
    }


    public function verificarMozo($request, $response, $next)
    {
        $token= $this->verificarBarearTokenOrFail($request);
        $userData = AutentificadorJWT::obtenerData($token);
        if(!$userData->isMozo)
        {
            throw new SysValidationException("Debe ser un mozo para ingresar a esta funcionalidad");
        }
        return $next($request, $response);
    }

    public function verificarPreparador($request, $response, $next)
    {
        $token= $this->verificarBarearTokenOrFail($request);
        $userData = AutentificadorJWT::obtenerData($token);
        if(!$userData->isPreparador)
        {
            throw new SysValidationException("Debe ser un empleado preparador para ingresar a esta funcionalidad");
        }
        return $next($request, $response);
    }



}