@extends('Layouts.menuPanel')

@section('page-content')
    <div class="card-header align-items-center">
        <h3 class="card-title text-125">
            <i class="nav-icon fa fa-store"></i>
            Nuevo producto
        </h3>
    </div>
    <form class="mt-lg-3 " id="frm-marketplaces" autocomplete="off" method="POST" action="{{route('marketplace.store')}}">
        @csrf


            <div class="form-group row mt-4">
                <!-- Nombre de modulo -->
                <div class="col-md-6 col-sm-12">
                    <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre del módulo') }}</label>
                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre_modulo" name="nombre_modulo" placeholder="Ingrese nombre del módulo" required="true"/>
                </div>

                <div class="col-md-3 col-sm-12">
                    <label for="precio" class="mb-0 text-blue-m1">{{ __('Precio del producto') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control brc-on-focus brc-blue-m1" id="precio" name="precio" required="true" placeholder="Ingrese el precio">
                    </div>
                    <span id="precioMostrado"></span>
                </div>

                <div class="col-md-3 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Estado del producto </label>
                        <div>
                          <input type="checkbox" id="estado" name="estado" class="ace-switch input-lg ace-switch-bars-h ace-switch-check ace-switch-times text-grey-l2 bgc-green-d2 radius-2px" style="margin-top: 1.8px;" checked="">
                            <input type="hidden"  id="valor_estado" name="valor_estado">
                        </div>
                </div>

            </div>

        <div class="form-group row mt-4">
            <div class="col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">{{ __('Descripción') }}</label>
                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese descripción de producto" style="resize: none; width: 100%; overflow-y: hidden;" required="true"></textarea>
            </div>
        </div>



            <!-- Agrega el botón de elección -->
        <!--<div class="form-group row mt-4">
                <div class="col-sm-12">
                    <label for="id-form-field-1" class="mb-0 text-blue-m1"> ¿Cómo desea agregar los términos y reglamentos? </label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="agregarTerminos" checked>
                        <label class="custom-control-label" for="agregarTerminos">Escribir Términos</label>
                    </div>
                    <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" id="insertarArchivo">
                        <label class="custom-control-label" for="insertarArchivo">Insertar Archivo</label>
                    </div>
                </div>
            </div>
            -->

            <!-- Área de texto para escribir términos -->
        <!--<div class="form-group row mt-4">
               <div class="col-sm-12">
                   <label for="id-form-field-1" class="mb-0 text-blue-m1"> Términos y Reglamentos </label>
                   <textarea class="form-control" id="terminos_condiciones" name="terminos_condiciones" placeholder="Ingrese términos y condiciones" style="resize: vertical; width: 100%; height: 200px; overflow-y: auto; white-space: pre-wrap;" required="true"></textarea>
               </div>
           </div>-->

        <div class="form-group row mt-4">
            <div class="col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">{{ __('Términos y Condiciones') }}</label>
                <textarea id="editor" name="editor"></textarea>
            </div>
        </div>





        <!-- Campo de carga de archivos -->
         <!--<div class="form-group row mt-4" id="campoArchivo" style="display: none;">
                <div class="col-sm-12">
                    <label for="id-form-field-1" class="mb-0 text-blue-m1"> Términos y Reglamentos </label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="documento" aria-describedby="inputGroupFileAddon01" multiple>
                            <label class="custom-file-label" for="inputGroupFile01">Seleccionar documentos</label>
                        </div>
                    </div>
                </div>
            </div>
            -->

            <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
                <div class="md-3 col-md-9 col-sm-12 text-nowrap">

                    <a href="{{ url()->previous() }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                            <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
                        </span>
                            Cancelar
                    </a>
                    <button type="button" id="registrar" data-toggle="modal" data-target="#confirmModal" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                            </span>
                        Registrar
                    </button>
                </div>
            </div>
    </form>

@endsection
<script type="module">
    $(document).ready(function(){
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote','alignment:left', 'alignment:center', 'alignment:right']
            } )
            .catch( error => {
                console.log( error );
            } );
    } );
</script>
