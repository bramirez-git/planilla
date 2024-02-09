@extends('Layouts.menuPanel')

@section('page-content')
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="card-title text-110 text-success pt-1">
                            Cargando Padrón Completo
                        </h5>
                    </div>

                    <div class="card-body">
                        <div id="upload-container" class="text-center">
                            <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
                            <div id="container_padron">
                                <a id="pickfiles" href="javascript:;" class="btn btn-primary mr-1">Seleccionar</a>
                                <a id="uploadfiles" href="javascript:;" class="btn btn-primary ml-1">Subir archivo</a>
                            </div>
                            <pre id="console"></pre>
                        </div>
                        <div  style="display: none" class="progress mt-3" style="height: 25px">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('cargarPadronElectoral') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div id="div_guardar_padron" class="md-3 col-md-9 col-sm-12 text-nowrap" style="display: none;">
                <button type="button" onclick="registrar_datos();" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                        <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                    </span>
                    Guardar Datos
                </button>
            </div>
        </div>
        <input type="hidden" id="archivo_cargado" value="0"/>
    </form>
    @include('componentes.modalCargando')
@endsection

@push('scripts')

@endpush
