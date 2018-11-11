<?php 
class Helpers
{
    public function getFile($varName)
    {
        if(!isset($_FILES[$varName]))
        {
            return false;
        } 
        return $_FILES[$varName];
    }

    public static  function validar( $var)
    {
        if(isset($_POST) && isset($_POST[$var]))
        {
           return $_POST[$var];
        }
        throw new ErrorException('faltan parametros');    
    }

    public static function slug($name)
    {
        return str_replace([' ','á','é','í','ú'],['-','a','e','i','o','u'],strtolower($name));
    }

    public static function getExtension($file)
    {
        $p = explode('.',$file);
        return end($p);
    }

}