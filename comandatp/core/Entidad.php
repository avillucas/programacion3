<?php
namespace Core;

use Core\Dao\IDao;

abstract class Entidad extends IDao
{
    /**
     * Crea la entidad y agrega a la base
     * @param $data
     * @return mixed
     */
    abstract static function crear($data);

    /**
     * Modifica la entidad y la guarda persiste
     * @param $id
     * @param $data
     * @return mixed
     */
    abstract static function modificar($id, $data);

    /**
     * Elimina la persistencia de la entidad
     * @param $id
     * @return mixed
     */
    abstract static function borrar($id);

    /**
     * Crea/Modifica la entidad en su persistencia
     */
    public function save()
    {
        if(isset($this->id)){
            $this->actualizar();
            return ;
        }
        $this->id =  $this->insertar();
        return ;
    }

    /**
     * Retorna una version en array de la entidad
     * @return array
     */
    abstract function __toArray();

    /**
     * Retorna una version en string de la entidad
     * @return string
     */
    public function __toString()
    {
        $data = array_map(function($key,$value){ return $key.':'.$value;},$this->__toArray());
        return implode(' ',$data);
    }

    /**
     * Retorna una version en json de la entidad, false si no puede convertirla
     * @return false|string
     */
    public function __toJson()
    {
        return json_encode($this->__toArray(),true);
    }

}