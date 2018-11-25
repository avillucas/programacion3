<?php
/**
 * Created by PhpStorm.
 * User: Lucas-notebook
 * Date: 25/11/2018
 * Time: 1:25 PM
 */

namespace Core;


class Alimento
{

    /** @var string $nombre */
    public $nombre;

    /** @var float $precio */
    public $precio;

    /** @var int $sector_id */
    public $sector_id;

    /**
     * Alimento constructor.
     * @param string $nombre
     * @param float $precio
     * @param int $sector_id
     */
    public function __construct($nombre, $precio, $sector_id)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->sector_id = $sector_id;
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
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param float $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * @return int
     */
    public function getSectorId()
    {
        return $this->sector_id;
    }

    /**
     * @param int $sector_id
     */
    public function setSectorId($sector_id)
    {
        $this->sector_id = $sector_id;
    }

}