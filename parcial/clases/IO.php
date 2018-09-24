<?php 
class IO
{
	public static function writeJson($content,$dir,$fileName,$permisos = 0755)
	{				
		try{							
			if(!file_exists($dir)){		
				mkdir($dir,$permisos);
			}			
			$gestor  = fopen($dir.DIRECTORY_SEPARATOR.$fileName, 'w'); 
			fwrite($gestor, $content);
			//escribir
			fclose($gestor);
		}	
		catch(Exception $e)
		{
			throw $e;
		}
	}

	public static function readJson($dir,$fileName)
	{
		$path = $dir.DIRECTORY_SEPARATOR.$fileName;
		if(!file_exists($path))
		{ 
			return false;		
		}
		$content = file_get_contents($path);
		return json_decode($content,true);
	}
}
