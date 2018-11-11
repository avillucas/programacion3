<?php 
include_once('config.php');
include_once('clases'.DIRECTORY_SEPARATOR.'helpers.php');
include_once('clases'.DIRECTORY_SEPARATOR.'IO.php');
include_once('clases'.DIRECTORY_SEPARATOR.'producto.php');
include_once('clases'.DIRECTORY_SEPARATOR.'productoCollection.php');
$lista =  new ProductoCollection();
/** CREATE **/
//VALIDANDO
$nombre = Helpers::validar('nombre');
$codigoBarras  = Helpers::validar('codigo');
//CREAR EL PRODUCTO
$producto = new Producto($nombre, $codigoBarras);
//ADD FOTO
$fileData = Helpers::getFile('foto');
// NOMBRE DEL ARCHIVO 
$fileName = Helpers::slug($producto->getFileName());
//crear la carpeta
IO::createIfNotExists(IMG_DIR);    
//ARMAR EL NOMBRE DEL ARCHIVO CON LA EXTENSION  DEStino 
$filePath = $fileName.'.'. Helpers::getExtension($fileData['name']);
//
$newpath =IMG_DIR.DIRECTORY_SEPARATOR.$filePath;        
if(file_exists($newpath))
{
    //crear la carpeta
    IO::createIfNotExists(BACKUP_DIR);    
    //backupear el archivo
    $backupPath = IO::backupFile($filePath,IMG_DIR,BACKUP_DIR);
}
//subir el archivo 
$filePath = IO::uploadFile($fileData,$newpath);
if($filePath === false )
{
 throw new \ErrorException('NO se pudo guardar la imagen');
}
$producto->setImage($filePath);
//
$lista->save( new Producto($nombre, $codigoBarras));	
//
echo $producto->__toJson();
//TODO guardar cada vez que se ingresa un producto 
//TODO devolver un json 
//TODO devolver una tabla 