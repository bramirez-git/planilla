<?php

namespace App\Http\Controllers;

use App\Funciones\Storage\cls_storage;
use App\Funciones\Storage\TempDir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function show($dir_group, $filename){
        $json=[];

        $dir_group_img = cls_storage::get_dir_group_file(session()->get('id_cliente'));

        if (array_key_exists($dir_group, $dir_group_img)) {
            $path = $dir_group_img[$dir_group]();
        } else {
            $path = '';
        }

        $path_filename=$path.$filename;
        if(!file_exists($path_filename) && !File::isReadable($path_filename)){
            $json['alert']='Archivo no encontrado en el servidor';
            return response()->json($json);
        }

        return response()->file($path_filename);

    }

    public function show_file_empresa($id_empresa,$dir_group, $filename){
        $json=[];

        $dir_group_img = cls_storage::get_dir_group_file($id_empresa);

        if (array_key_exists($dir_group, $dir_group_img)) {
            $path = $dir_group_img[$dir_group]();
        } else {
            $path = '';
        }

        $path_filename=$path.$filename;
        if(!file_exists($path_filename) && !File::isReadable($path_filename)){
            $json['alert']='Archivo no encontrado en el servidor';
            return response()->json($json);
        }

        return response()->file($path_filename);

    }




}
