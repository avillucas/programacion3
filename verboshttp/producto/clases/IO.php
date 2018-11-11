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
    
    public static function uploadFile($fileData,$newPath)
    {                             
        if( move_uploaded_file($fileData["tmp_name"], $newPath))
        {
            return $newPath;
        }   
        return false;
    }
    
    public static function createIfNotExists($file)
    {
        if(!file_exists($file))
        {            
            mkdir($file);            
        }   
    }
    public static function backupFile($fileName,$fileDir,$backupDir)
    {
        //se asume que el path esta compuesto de un solo directorio
        //la ruta del archivo en backup
        $backupPath =  $backupDir.DIRECTORY_SEPARATOR.time().''.$fileName;
        //la ruta del archivo original 
        $filePath = $fileDir.DIRECTORY_SEPARATOR.$fileName;
        if(rename($filePath,$backupPath) !== false)
        {
            return $backupPath;
        }
        return false;
    }
}
