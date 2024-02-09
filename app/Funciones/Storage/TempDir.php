<?php
namespace App\Funciones\Storage;
/**
 * Clase para la gestión de archivos y carpetas temporales
 */
class TempDir{
	/**
	 * @var array Lista de archivos temporales que se eliminarán al destruir este objeto
	 */
	private $path='';

	/**
	 * TempDir constructor.
	 * @param string $path
	 */
	private function __construct($path){
		$this->path=$path;
	}

	/**
	 * Programa la eliminación del archivo cuando el proceso termine
	 * @param string $path
	 * @return bool
	 */
	public static function auto_destroy_file($path){
		if($path && is_string($path=realpath($path))){
			register_shutdown_function(function($path){
				static::destroy_file($path);
			},$path);
			return true;
		}
		return false;
	}

	/**
	 * Programa la eliminación de la carpeta cuando el proceso termine
	 * @param string $path
	 * @return bool
	 */
	private static function auto_destroy_dir($path){
		if($path && is_string($path=realpath($path))){
			register_shutdown_function(function($path){
				static::destroy_dir($path);
			},$path);
			return true;
		}
		return false;
	}

	/**
	 * Crea un archivo/carpeta con un nombre aleatorio
	 * @param string|null $dir
	 * @param string $prefix Prefijo del nombre del archivo
	 * @param string $ext Extensión del archivo. Si es vacío, se utiliza la extensión "tmp"
	 * @param bool $makedir Si es TRUE, crea una carpeta, de lo contrario, crea un archivo
	 * @return string|null Ruta del nuevo archivo/carpeta
	 */
	public static function tmp_random(?string $dir=null, string $prefix='', string $ext='', bool $makedir=false){
		if(is_null($dir) || !is_dir($dir)) $dir=sys_get_temp_dir();
		$uid=base_convert(uniqid(), 16, 36);
		$prefix=str_replace(['\\','/'], '_', $prefix);
		$ext=str_replace(['\\','/'], '_', $ext);
		$i=0;
		do{
			$path=$dir.'/'.$prefix.$uid.($i?'('.$i.'-'.base_convert(bin2hex(random_bytes(3)), 16, 36).')':'').'.'.($ext?:'tmp');
			if(!file_exists($path)){
				if($makedir && mkdir($path,0777)){
					return $path;
				}
				elseif(!$makedir && ($f=@fopen($path,'x'))){
					fclose($f);
					return $path;
				}
			}
		}while(++$i<100);
		return null;
	}

	/**
	 * Intenta crear una carpeta temporal, la cual se destruirá cuando finalize el proceso actual
	 * @param null|string $dir
	 * @return bool|static
	 */
	public static function create($dir=null, $prefix=''){
		if(is_string($dir)){
			$dir=realpath($dir);
			if(!$dir) return false;
		}
		if(is_null($dir)) $dir=sys_get_temp_dir();
		if(!is_dir($dir)) return false;
		$tempdir=self::tmp_random($dir, $prefix, 'dir', true);
		if($tempdir){
			static::auto_destroy_dir($tempdir);
			return new static($tempdir);
		}
		return false;
	}

	/**
	 * @return string
	 */
	public function __toString(){
		return $this->path;
	}

	/**
	 * @return void
	 * @see TempDir::empty_dir()
	 */
	public function unlink_content(){
		static::empty_dir($this->path);
	}

	/**
	 * #CUIDADO!!!
	 * ##Debe asegurarse de que la ruta es correcta, ya que el archivo/carpeta y su contenido se eliminará de inmediato
	 * @param $path
	 * @return bool
	 */
	public static function destroy_path($path){
		if(is_dir($path)){
			return self::destroy_dir($path);
		}
		elseif(is_file($path)){
			return self::destroy_file($path);
		}
		return false;
	}

	/**
	 * #CUIDADO!!!
	 * ##Debe asegurarse de que la ruta es correcta, ya que el archivo de esta ruta se eliminará de inmediato
	 * @param $path
	 * @return bool
	 */
	public static function destroy_file($path){
		if(strlen($path)>0 && is_file($path)){
			return unlink($path);
		}
		return false;
	}

	/**
	 * #CUIDADO!!!
	 * ##Debe asegurarse de que la ruta es correcta, ya que la carpeta y su contenido se eliminará de inmediato
	 * @param $path
	 * @return bool
	 */
	public static function destroy_dir($path){
		if(strlen($path)>0 && is_dir($path)){
			static::empty_dir($path);
			return rmdir($path);
		}
		return false;
	}

	/**
	 * #CUIDADO!!!
	 * ##Debe asegurarse de que la ruta es correcta, ya que los archivos/carpetas se eliminarán de inmediato
	 * Destruye el contenido de la carpeta, eliminando recursivamente todos los archivos y subcarpetas
	 * @param $path
	 * @return void
	 */
	public static function empty_dir($path){
		if(strlen($path)>0 &&$rdir=opendir($path)){
			while(is_string($f=readdir($rdir))){
				if($f==='.' || $f==='..') continue;
				if(is_dir($path.'/'.$f)){
					static::empty_dir($path.'/'.$f);
					rmdir($path.'/'.$f);
				}
				elseif(is_file($path.'/'.$f)){
					unlink($path.'/'.$f);
				}
			}
			closedir($rdir);
		}
	}

	/**
	 * #CUIDADO!!!
	 * ##Debe asegurarse de que la ruta de la carpeta es correcta, ya que los archivos/carpetas que cumplen las condiciones se eliminarán de inmediato
	 *
	 * Elimina el contenido de la carpeta con tiempos anteriores al tiempo indicado, por lo que solo los archivos y carpetas más recientes se conservan.<br>
	 * Los tiempos de creación, modificación y lectura se evalúan para determinar si el archivo/carpeta se elimina.<br>
	 * @param string $path Carpeta inicial. Esta carpeta no se elimina, solo su contenido
	 * @param int $max_time Tiempo (UNIX). Cualquier archivo/carpeta anterior a esta tiempo es eliminado
	 * @param bool $recursive Si es TRUE, el árbol completo de carpetas se evaluará. Si es FALSE, solo el contenido inmediato de la carpeta inicial es eliminado
	 * @param bool $rmdirs Si es TRUE, tambien se eliminan las carpetas
	 * @return int|false Cantidad de archivos y carpetas eliminadas.<br>
	 * Devuelve FALSE si el tiempo no es un Integer válido o la ruta de la carpeta no se puede leer
	 */
	public static function unlink_older_content($path, int $max_time, $recursive=true, $rmdirs=false){
		clearstatcache();
		$path=strval($path);
		if(empty($path)) return false;
		if($max_time<0) return false;
		if(!($rdir=opendir($path))){
			return false;
		}
		$deleted=0;
		while(is_string($f=readdir($rdir))){
			if($f==='.' || $f==='..') continue;
			$f=$path.'/'.$f;
			$delete=(fileatime($f)<$max_time && filemtime($f)<$max_time && filectime($f)<$max_time);
			if(is_dir($f)){
				if($recursive){
					$deleted+=static::unlink_older_content($f, $max_time, $recursive, $rmdirs);
				}
				if(!$delete || !$rmdirs) continue;
				if(rmdir($f)){
					++$deleted;
				}
			}
			elseif(is_file($f)){
				if(!$delete) continue;
				if(unlink($f)){
					++$deleted;
				}
			}
		}
		closedir($rdir);
		return $deleted;
	}

}
