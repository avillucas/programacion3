<?php
/**
 * Created by PhpStorm.
 * User: Lucas-notebook
 * Date: 25/11/2018
 * Time: 1:05 PM
 */

namespace Core;


abstract class Estado
{

    /** @var string $nombre */
    protected $nombre;

    /**
     * Estado constructor.
     * @param string $nombre
     */
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    protected function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }


}