<?php 
class UsuariosLista
{
	private $items ;
	const FILE_DIR = 'datos';
	const FILE_NAME = 'usuario.json';

	public function __construct()
	{
		$this->items = [];
		$this->load();		
	}

	private function getNextId()
	{
		$last = end($this->items);
		return  intval($last->getId())+1;		
	}

	public function save(Usuario &$usuario)
	{		
		if(!$usuario->hasId()){ 
			$id = $this->getNextId();
			$usuario->setId($id);
		}							
		$this->items[$usuario->getId()] = $usuario->__toArray();
		$this->saveData();
	}

	//TODO 
	public function delete($id)
	{		
		foreach($this->items as $k => $item)
		{
			if($item['id'] == $id)
			{
				unset($this->items[$k])
				$this->saveData();
				return true;
			}
		}
		return false;
	}

	private function saveData()
	{
		$content = json_encode($this->items, true);
		IO::writeJson($content,self::FILE_DIR,self::FILE_NAME);
	}

	private  function load()
	{
		$items = IO::readJson(self::FILE_DIR,self::FILE_NAME);
		if($items !== false)
		{
			$this->items = $items;
		}
	}

	public  function __toJson()
	{
		return json_encode($this->items, true);		
	}

	public  function __toArray()
	{		
		return $this->items;
	}

	public function count()
	{
		return count($this->items);
	}	

}
