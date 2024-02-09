<?php

namespace App\Http\Controllers;

use App\Funciones\Storage\cls_storage;
use App\Funciones\Storage\TempDir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DropzoneController extends Controller
{
    /**

     * Generate Image upload View

     *

     * @return void

     */

    public function index()
    {
        return view('dropzone');
    }

    /**

     * Image Upload Code

     *

     * @return void

     */

    public function store(Request $request)
    {
        $documento = $request->file('file');
        $nombreDocumento = $documento->getClientOriginalName();

        if(session()->get('documentos')=="") {
            $dir = cls_storage::dir_warehouse_tmp_backup_doc($request->session()->get('id_cliente'),cls_storage::filename_doc());
        }
        else{
            $dir = session()->get('documentos');
        }

        $documento->move($dir,$nombreDocumento);

        session(['documentos'=>$dir]);

        return response()->json(['success'=>$documento]);

    }

    //arreglar
    public function delete(Request $request)
    {
        $dir= session()->get('documentos');

        if(File::exists($dir.$_POST['name'])) {
            TempDir::destroy_file($dir . $_POST['name']);
        }

        if(count(glob($dir."*"))==0){
            TempDir::destroy_dir($dir);
            session(['documentos'=>""]);
        }

        return session()->get('documentosAccion');
    }
}
