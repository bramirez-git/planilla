<?php

namespace App\Funciones\Storage;

use App\Funciones\Storage\TempDir;
use App\Funciones\Seguridad\SecureValue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class cls_storage{

    const REGEXP_PATH_SPLITTERS='/(^[a-z]:)?[\\\\\/]+/i';
    const PATH_SPLITTER='/';
    const ROOT_WAREHOUSE= 'files/warehouse/';
    const ROOT_FILESYSTEMS= 'files/filesystems/';
    const ROOT_TMP_BACKUP_DOC= 'files/tmp_backup_doc/';
    protected static $PATH_ROOT=null;
    protected static $PATH_ROOT_LENGTH=null;

    public const WAREHOUSE_FILE_GROUP=[
        0=>'default',
        1=>'acciones_personal',
        2=>'documentos_digitales',
    ];

    public const WAREHOUSE_IMG_GROUP=[
        0=>'default',
        1=>'colaboradores',
        2=>'empresa',
        3=>'usuarios',
        4=>'wysiwyg',
    ];

    public const FILESYSTEMS_IMG_GROUP=[
        0=>'default',
        1=>'colaboradores',
        2=>'empresa',
        3=>'usuarios',
    ];

    protected function __construct(){ }

    /**
     * Crea todas las carpetas que faltan de la ruta, aplicando los mismos permisos en las creadas
     * @param string $directory
     * @param int $permissions Default: 0777
     * @return bool|null Devuelve NULL si la ruta no es válida desde su raíz
     */
    static function mkdir_recursive($directory, $permissions=0777) {
        if(!file_exists($parent=dirname($directory))){
            if($parent==$directory) return null;
            if(self::mkdir_recursive($parent, $permissions)===null) return null;
        }
        if(mkdir($directory, $permissions)){
            chmod($directory, $permissions);
            return true;
        }
        return false;
    }

    static function normalizePath($path){
        return preg_replace(self::REGEXP_PATH_SPLITTERS, self::PATH_SPLITTER, $path);
    }

    static function rootdir_filesystems($id_empresa=null, $subdir=''){
        $dir=storage_path(self::ROOT_FILESYSTEMS);
        if(!is_null($id_empresa)){
            $dir.=self::zerofill(trim($id_empresa), 1).'/';
        }
        $dir.=trim($subdir).'/';
        return self::normalizePath($dir);
    }
    static function rootdir_tmp_backup_doc($id_empresa=null, $subdir=''){
        $dir=storage_path(self::ROOT_TMP_BACKUP_DOC);
        if(!is_null($id_empresa)){
            $dir.=self::zerofill(trim($id_empresa), 1).'/';
        }
        $dir.=trim($subdir).'/';
        return self::normalizePath($dir);
    }

    static function rootdir_warehouse($id_empresa=null, $subdir=''){
        $dir=storage_path(self::ROOT_WAREHOUSE);
        if(!is_null($id_empresa)){
            $dir.=self::zerofill(trim($id_empresa), 1).'/';
        }
        $dir.=trim($subdir).'/';
        return self::normalizePath($dir);
    }

    static function rootdir_warehouse_filesystems($id_empresa,$subdir_name){
        return self::rootdir_filesystems($id_empresa, $subdir_name);
    }

    static function dir_warehouse_filesystems($id_empresa,$subdir_name){
        $id_empresa=trim($id_empresa);
        $dir=self::rootdir_warehouse_filesystems($id_empresa,$subdir_name);
        if(!$id_empresa) return $dir;
        if(!realpath($dir)){
            if(!self::mkdir_recursive($dir)){
                if(!realpath($dir)){
                    return 'Error al crear carpeta';
                    //                    EasyDebug::notify('Error al crear carpeta', $dir.PHP_EOL.print_r(error_get_last(), 1));
                }
            }
        }
        return $dir;
    }

    static function rootdir_warehouse_filesystems_img_group($id_empresa,$group){
        return self::rootdir_warehouse_filesystems($id_empresa, 'img/'.$group);
    }

    static function dir_warehouse_filesystems_img_group($id_empresa,$group=0){
        $id_empresa=trim($id_empresa);
        $dir=self::rootdir_warehouse_filesystems_img_group($id_empresa,self::FILESYSTEMS_IMG_GROUP[$group]);
        if(!$id_empresa) return $dir;
        if(!realpath($dir)){
            if(!self::mkdir_recursive($dir)){
                if(!realpath($dir)){
                    return 'Error al crear carpeta';
                    //                    EasyDebug::notify('Error al crear carpeta', $dir.PHP_EOL.print_r(error_get_last(), 1));
                }
            }
        }
        return $dir;
    }

    static function rootdir_warehouse_tmp_backup_doc($id_empresa,$subdir_name=''){
        return self::rootdir_tmp_backup_doc($id_empresa, $subdir_name);
    }

    static function dir_warehouse_tmp_backup_doc($id_empresa,$subdir_name=''){
        $id_empresa=trim($id_empresa);
        $dir=self::rootdir_warehouse_tmp_backup_doc($id_empresa,$subdir_name);
        if(!$id_empresa) return $dir;
        if(!realpath($dir)){
            if(!self::mkdir_recursive($dir)){
                if(!realpath($dir)){
                    return 'Error al crear carpeta';
                    //                    EasyDebug::notify('Error al crear carpeta', $dir.PHP_EOL.print_r(error_get_last(), 1));
                }
            }
        }
        return $dir;
    }


    static function rootdir_warehouse_acciones_personal($id_empresa){
        return self::rootdir_warehouse($id_empresa, 'acciones_personal');
    }

    static function dir_warehouse_acciones_personal($id_empresa){
        $id_empresa=trim($id_empresa);
        $dir=self::rootdir_warehouse_acciones_personal($id_empresa);
        if(!$id_empresa) return $dir;
        if(!realpath($dir)){
            if(!self::mkdir_recursive($dir)){
                if(!realpath($dir)){
                    return 'Error al crear carpeta';
//                    EasyDebug::notify('Error al crear carpeta', $dir.PHP_EOL.print_r(error_get_last(), 1));
                }
            }
        }
        return $dir;
    }

    static function rootdir_warehouse_documentos_digitales($id_empresa){
        return self::rootdir_warehouse($id_empresa, 'documentos_digitales');
    }

    static function dir_warehouse_documentos_digitales($id_empresa){
        $id_empresa=trim($id_empresa);
        $dir=self::rootdir_warehouse_documentos_digitales($id_empresa);
        if(!$id_empresa) return $dir;
        if(!realpath($dir)){
            if(!self::mkdir_recursive($dir)){
                if(!realpath($dir)){
                    return 'Error al crear carpeta';
                    //                    EasyDebug::notify('Error al crear carpeta', $dir.PHP_EOL.print_r(error_get_last(), 1));
                }
            }
        }
        return $dir;
    }

    static function rootdir_warehouse_wysiwyg($id_empresa){
        return self::rootdir_warehouse($id_empresa, 'wysiwyg');
    }

    static function dir_warehouse_wysiwyg($id_empresa){
        $id_empresa=trim($id_empresa);
        $dir=self::rootdir_warehouse_wysiwyg($id_empresa);
        if(!$id_empresa) return $dir;
        if(!realpath($dir)){
            if(!self::mkdir_recursive($dir)){
                if(!realpath($dir)){
                    return 'Error al crear carpeta';
                    //                    EasyDebug::notify('Error al crear carpeta', $dir.PHP_EOL.print_r(error_get_last(), 1));
                }
            }
        }
        return $dir;
    }

    /**
     * @param $path
     * @param $file
     * @param $filename
     * @param string $alert
     * @return bool
     */
    static function save_file($path, $file, $filename, &$alert=''): bool{
        if(is_string($path)){
            $ext=strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if(in_array($ext, self::get_allowed_extensions())===false){
                $alert='No es un archivo válido: '.$filename;
                $alert.='<br>Extensiones válidas: '.implode(', ', self::get_allowed_extensions());
                return false;
            }
            $rpath=realpath($path);
            if($rpath){
                clearstatcache(true, $rpath);
                $type=filetype($rpath);
                if(!$type){
                    $alert='No se pudo leer el tipo de "'.$rpath.'"';
                    return false;
                }
                $stat=stat($rpath);
                if(!$stat){
                    $alert='No se pudo leer los metadatos de "'.$rpath.'"';
                    return false;
                }
                // Verificar si el archivo ya existe en la carpeta de destino
                if (Storage::exists("{$path}{$filename}")) {
                    $alert = "El archivo '{$filename}' ya existe en la carpeta '{$path}'";
                    return false;
                }
                if(!copy($file, "{$path}{$filename}")){
                    // Puedes realizar otras acciones necesarias aquí
                    $alert='Error al copiar el archivo a la carpeta de almacenamiento: '.$filename;
                    return false;
                }
                $alert='El archivo se guardo en la carpeta de almacenamiento'.$path;
                return true;

            }
            else{
                $alert='No existe la ruta'.$path;
                //No existe la ruta
                return false;
            }
        }
        $alert='La ruta no es valida'.$path;
        return false;
    }

    public static function size_warehouse($id_empresa)
    {
        // Obtiene la ruta de la carpeta asociada a la empresa
        $folderPath = self::normalizePath(storage_path(self::ROOT_WAREHOUSE . $id_empresa)); // Ajusta según tu estructura de carpetas

        // Verifica si la carpeta existe
        if(file_exists($folderPath)) {
            // Inicializa la variable para almacenar el tamaño total
            // Calcula el tamaño total de la carpeta
            $totalSize = 0;

            // Obtiene la lista de archivos en la carpeta
            $files = File::allFiles($folderPath);

            // Calcula el tamaño total sumando los tamaños de cada archivo
            foreach ($files as $file) {
                $totalSize += File::size($file->getPathname());
            }

            // Devuelve el tamaño total
            return $totalSize;
        } else {
            return "La carpeta no existe.";
        }
    }

    static function filename_doc($ext='pdf'){
        $md5_encode=SecureValue::md5_base64(Carbon::now()->format('Y-m-s-H-i-s').Str::random(6).'.'.$ext);
        return $md5_encode.'.'.$ext;
    }

    /**
     * @param $path
     * @param bool $to_relative
     * @param bool $add_splitter
     * @return bool|string
     */
    static function clean_path($path, $to_relative=true, $add_splitter=true){
        if($add_splitter && $path!=''){
            $path=$path.self::PATH_SPLITTER;
        }
        $new_path=self::normalizePath($path);
        if($to_relative && strlen($new_path)>self::path_root_length() && strpos($new_path, self::path_root())===0){
            $new_path=substr($new_path, self::path_root_length());
        }
        return $new_path;
    }


    /**
     * Comprueba si una ruta puede ser registrada
     * @param string $path Ruta
     * @return bool TRUE, si es registrable.
     */
    static function is_registrable($path){
        if(strpos(self::clean_path($path), self::ROOT_WAREHOUSE)===0){
            return true;
        }
        return false;
    }

    /**
     * @param string $path
     * @return string
     */

    static function zerofill($str, $length=11){
        return str_pad($str, $length,'0',STR_PAD_LEFT);
    }

    static function path_root(){
        if(!is_string(self::$PATH_ROOT)){
            self::$PATH_ROOT=self::normalizePath(realpath(getcwd()).'/');
            self::$PATH_ROOT_LENGTH=null;
        }
        return self::$PATH_ROOT;
    }

    protected static function path_root_length(){
        if(!is_numeric(self::$PATH_ROOT_LENGTH)){
            self::$PATH_ROOT_LENGTH=strlen(self::path_root());
        }
        return self::$PATH_ROOT_LENGTH;
    }

    /**
     * Función para obtener un array con las extenciones permitidas para subir al servidor.
     * @return array Listado de extensiones
     */
    static function get_allowed_extensions(){
        return array(
            'doc',
            'docx',
            'xls',
            'xlsx',
            'ppt',
            'pptx',
            'pdf',
            'txt',
            'jpeg',
            'xml',
            'jpg',
            'png',
            'svg',
            'gif',
            'csv'
        );
    }

     static function get_dir_group_img($id_empresa) {
        return [
            'wysiwyg' => function () use ($id_empresa) {
                return self::dir_warehouse_wysiwyg($id_empresa);
            },
            'colaboradores' => function () use ($id_empresa) {
                return self::dir_warehouse_filesystems_img_group($id_empresa, 1);
            },
            'empresa' => function () use ($id_empresa) {
                return self::dir_warehouse_filesystems_img_group($id_empresa, 2);
            },
            'usuarios' => function () use ($id_empresa) {
                return self::dir_warehouse_filesystems_img_group($id_empresa, 3);
            },
        ];
    }


     static function get_dir_group_file($id_empresa) {
        return [
            'acciones_personal' => function () use ($id_empresa) {
                return self::dir_warehouse_acciones_personal($id_empresa);
            },
            'documentos_digitales' => function () use ($id_empresa) {
                return self::dir_warehouse_documentos_digitales($id_empresa);
            }
        ];
    }

    /**
     * Elimina de forma definitiva los archivos y carpetas en el directorio TMP_BACKUP_DOC
     * @return false|int Cantidad de archivos eliminados
     */
    public static function clean_tmp_backup_doc(){
//        $maxtime=strtotime('1 second');
        $maxtime=strtotime('-7 weekdays');
        try{
            $path_file=storage_path('files/tmp_backup_doc');
            if (file_exists($path_file) && File::isReadable($path_file)) {
                TempDir::unlink_older_content(self::normalizePath(storage_path('files/tmp_backup_doc')), $maxtime, true,true);
            }
        }catch(\Exception $e){

        }
    }


}
