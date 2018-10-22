<?php
class Perfil implements IEntidad
{
    public $id = null;
    public $nombre;

    public function __construct($id=null, $nombre=null)
    {
       if(isset($id)){
            $this->id = $id;
       }
       if(isset($nombre))
       {
            $this->nombre = $nombre;
       }
    }

    function save()
    {
        // TODO: Implement save() method.
    }

    static function crear($data)
    {
        // TODO: Implement crear() method.
    }

    static function modificar($id, $data)
    {
        // TODO: Implement modificar() method.
    }

    function insertar()
    {
        // TODO: Implement insertar() method.
    }

    function actualizar()
    {
        // TODO: Implement actualizar() method.
    }

    static function borrar($id)
    {
        // TODO: Implement borrar() method.
    }

    function eliminar()
    {
        // TODO: Implement eliminar() method.
    }

    static function traerTodos()
    {
        // TODO: Implement traerTodos() method.
    }

    static function traerUno($id)
    {
        // TODO: Implement traerUno() method.
    }

    function __toString()
    {
        return '';
    }

    function __toArray()
    {
        // TODO: Implement __toArray() method.
    }

    function __toJson()
    {
        // TODO: Implement __toJson() method.
    }


}