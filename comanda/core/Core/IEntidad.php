<?php
namespace Core\Core;

interface IEntidad
{

    function save();

    static function crear($data);

    static function modificar($id, $data);

    static function borrar($id);

    static function traerTodos();

    static function traerUno($id);

    function __toString();

    function __toArray();

    function __toJson();

}