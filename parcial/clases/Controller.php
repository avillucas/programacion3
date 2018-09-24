<?php 
class Controller
{
	/**
	 * 	caso: cargarAlumno (post): Se deben guardar los siguientes datos: nombre, apellido, email y foto. Los
	 *  datos se guardan en el archivo de texto alumnos.txt, tomando el email como identificador.
	**/
	public static function cargarAlumno()
	{
		throw new Exception('No implementado aun ');
	}
/**
 * caso: consultarAlumno (get): Se ingresa apellido, si coincide con algún registro del archivo alumno.txt se
 * retorna todos los alumnos con dicho apellido, si no coincide se debe retornar “No existe alumno con apellido
 * xxx” (xxx es el apellido que se busco) La búsqueda tiene que ser case insensitive
**/
	public static function consultarAlumno()
	{
		throw new Exception('No implementado aun ');
	}
	/**
	 * 	3- (1 pts.) caso: cargarMateria (post): Se recibe el nombre de la materia, código de materia, el cupo de alumnos y
	 * el aula donde se dicta y se guardan los datos en el archivo materias.txt, tomando como identificador el código de
	 * la materia
	 * **/

	public static function cargarMateria()
	{
		throw new Exception('No implementado aun ');
	}

	/**
	 * 4- (2pts.) caso: inscribirAlumno (get): Se recibe nombre, apellido, mail del alumno, materia y código de la materia
	*y se guarda en el archivo inscripciones.txt restando un cupo a la materia en el archivo materias.txt. Si no hay
	*cupo o la materia no existe informar cada caso particular	 *
	 * @return void
	 */
	public static function inscribirAlumno()
	{
		throw new Exception('No implementado aun ');
	}
	/**
	 * 5- (1pt.) caso: inscripciones(get): Se devuelve un tabla con todos los alumnos inscriptos a todas las materias.
	 *
	 * @return void
	 */
	/**
	 * 6- (2pts.) caso: inscripciones(get): Puede recibir el parámetro materia o apellido y filtra la tabla de acuerdo al
	 * parámetro pasado.
	 *
	 * @return void
	 */
	public static function inscripciones()
	{
		throw new Exception('No implementado aun ');
	}

	/**
	 * 7- (2 pts.) caso: modificarAlumno(post): Debe poder modificar todos los datos del alumno menos el email y
	 * guardar la foto antigua en la carpeta /backUpFotos , el nombre será el apellido y la fecha.
	 *
	 * @return void
	 */
	public static function modificarAlumno()
	{
		throw new Exception('No implementado aun ');
	}
	/**
	 * 8- (2 pts.) caso: alumnos (get): Mostrar una tabla con todos los datos de los alumnos, incluida la foto * 
	 */
	public static function alumnos()
	{
		throw new Exception('No implementado aun ');
	}
}
