<?php

namespace App\Http\Controllers;

use App\Funciones\Storage\cls_storage;
use App\Funciones\Storage\TempDir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UploadController extends Controller
{
    /**

     * Generate Image upload View

     *

     * @return void

     */

    public function index()
    {

    }

    public function store(Request $request)
    {
        session()->now('wysiwyg','1');

        $validator = Validator::make($request->all(), [
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        if($validator->fails()){
            return response()->json(['error' => true,'messages'=>$validator->errors()->messages()['upload'][0]]);
        }

        $imagen = $request->file('upload');
        $path=cls_storage::dir_warehouse_wysiwyg(session()->get('id_cliente'));
        $filename= cls_storage::filename_doc( $imagen->extension());
        $save=cls_storage::save_file($path, $imagen, $filename);

        return response()->json(['link' => route('image.show', ['dir_group' =>'wysiwyg' ,'filename' => $filename])]);

    }

    public function delete(Request $request)
    {
        $path=cls_storage::dir_warehouse_wysiwyg(session()->get('id_cliente'));

        $filename = basename($request->input('url_name'));
        $path_filename=$path.$filename;
        try{
            if (file_exists($path_filename) && File::isReadable($path_filename)) {
                TempDir::destroy_file($path_filename);
                $existe_path = true;
            } else {
                $existe_path = false;
            }
        }catch(\Exception $e){
            $existe_path=false;
        }

        return response()->json(['success'=>$existe_path]);
    }
}
