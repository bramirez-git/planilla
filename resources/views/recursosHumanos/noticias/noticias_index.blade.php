@extends('Layouts.menu')

@section('page-content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            <a href="{{ route('noticias.create') }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
						</span>
                Agregar Noticia
            </a>
        </div>

        <div class="text-nowrap align-self-start pl-md-2">
            <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                <div class="d-flex flex-row-reverse">
                    <div class="px-1">
                        <div class="d-inline-flex dropdown dd-backdrop dd-backdrop-none-lg h-100" data-display="static">
                            <input type="text" class="form-control mr-n3 pr-5 h-100" placeholder="Filtros de búsqueda" readonly/>
                            <a data-display="static" href="#" class="align-self-center btn border-0 btn-outline-default py-1 px-2 btn-h-light-primary btn-a-light-primary radius-1 ml-n35" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-filter"></i>
                            </a>
                            <div data-display="static" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
                                <div class="dropdown-inner">
                                    <h5 class="bgc-secondary-l3 text-secondary-d3 d-md-none text-center mb-2 py-25">
                                        Filtros de búsqueda </h5>
                                    <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" id="frm_filtros" action="{{route('noticias.index')}}">
                                        @csrf
                                        <input type="text" value="{{ route('clientes.index') }}" hidden name="url"/>
                                        <div class="dropdown-body my-25 px-3">
                                            <div class="d-flex align-items-center px-2 px-md-3 mt-3 mb-3">
                                                <div class="text-nowrap">Titulo:</div>
                                            </div>
                                            <div class="px-2 px-md-3">
                                                <input type="text" id="buscar" value="{{ $buscar ?? '' }}" name="buscar" class="form-control" placeholder="Buscar ..."/>
                                            </div>
                                            <hr class="brc-default-l3"/>
                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4 text-nowrap">Estado:</div>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round mr-1">
                                                        <input type="radio" name="filtro[estado][]" @if($estado=="0") checked  @endif value="0"> Todos
                                                    </label>
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round mr-1">
                                                        <input type="radio" name="filtro[estado][]" @if($estado=="publicado"||$estado=="") checked  @endif value="publicado"> Publicado
                                                    </label>
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round">
                                                        <input type="radio" name="filtro[estado][]" @if($estado=="borrador") checked  @endif value="borrador"> Borrador
                                                    </label>
                                                </div>
                                            </div>
                                            <hr class="brc-default-l3"/>
                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4 text-nowrap">Fecha de publicación</div>
                                                <div class="input-group input-daterange sticky-top">
                                                    <input type="text" data-placement="button" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" placeholder="Desde" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaIngreso" name="filtro[fecha_ingreso]" value="{{ $fecha1 }}"/>
                                                </div>
                                                <label class="m-2">-</label>
                                                <div class="input-group input-daterange sticky-top">
                                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" placeholder="Hasta" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaFinal" name="filtro[fecha_final]" value="{{ $fecha2 }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-footer py-2 bgc-secondary-l4 text-center position-relative border-t-1 brc-secondary-l2">
                                            <button type="submit" onclick="waitingDialog.show();" class="btn px-4 py-15 text-95 btn-default btn-modal-cargando">
                                                Buscar
                                            </button>
                                            <a id="limpiarCampos" class="btn px-25 py-15 text-95 btn-outline-default">
                                                Limpiar filtros
                                            </a>
                                        </div>
                                    </form>
                                </div><!-- .dropdown-inner -->
                            </div>
                        </div>
                    </div>

                    <div class="px-1">
                        <a href="{{route('noticias.index')}}" onclick="waitingDialog.show();" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100 btn-modal-cargando">
                            <i class="nav-icon fa fa-retweet"></i>
                        </a>
                    </div>
{{--                    @if(!$resultado->isEmpty())--}}
{{--                        <div class="px-1">--}}
{{--                            <a href="" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">--}}
{{--                            <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">--}}
{{--                                <i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>--}}
{{--                            </span>--}}
{{--                                Exportar excel--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                </div>
            </div>
        </div>
    </div>
    @if($resultado->isEmpty())
        <div class="alert alert-warning">
            No se encuentran registros
        </div>
    @else
    <div class="table-responsive">

        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th class="text-center text-secondary-d2 text-95 text-600">
                    Titulo
                </th>

                <th class=" text-secondary-d2 text-95 text-600 text-center">
                    Guardado como
                </th>

                <th class="text-center text-secondary-d2 text-95 text-600">
                    Fecha de publicaci&oacute;n
                </th>
                <th class="text-center text-secondary-d2 text-95 text-600">
                    Descripción de la noticia
                </th>

                <th class="text-left text-secondary-d2 text-95 text-600">
                    Acción
                </th>
            </tr>
            </thead>

            <tbody class="mt-1">
            <input type="hidden" id="noticiasDestroyUrl" data-url-destroy="{{ route('noticias.destroy', ['1']) }}">
            @foreach($resultado as $datos)
            <tr class="bgc-h-blue-l4 d-style">

                <td class="d-none d-sm-table-cell text-600 text-primary-d2 text-center">
                   {{ $datos->titulo }}
                </td>

                <td class="d-none d-sm-table-cell text-600 text-orange-d2 text-center">
                    @if($datos->estado=='publicado')
                        <span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Publicado</span>
                    @elseif($datos->estado=='borrador')
                        <span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Borrador</span>
                    @elseif($datos->estado=='eliminado')
                        <span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-25">Eliminado</span>
                    @else
                        <span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Publicado</span>
                    @endif
                </td>
                <td class='text-grey text-95 text-center'>
                    {{ Carbon::parse($datos->fecha)->locale('es_ES')->isoFormat('dddd D [de] MMMM [del] YYYY') }}

                </td>
                <td class="text-center">
                    <a href="#" data-rel="tooltip" data-placement="top" data-toggle="collapse" data-target="#table-detail-{{$datos->id_noticia}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-orange btn-a-lighter-orange collapsed" data-original-title="Mostrar descripción">
                        <i class="fa fa-eye text-110 text-orange-d2"></i>
                    </a>
                </td>

                <td class="text-center">
                    @if($datos->estado!=='eliminado')
                    <!-- action buttons -->
                        <div class='d-none d-lg-flex float-left'>
                            <a href="{{ route('noticias.edit',[Crypt::encrypt($datos->id_noticia)]) }}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <a onclick="delete_noticia('{{Crypt::encrypt($datos->id_noticia)}}');"  class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                        </div>

                        <!-- show a dropdown in mobile -->
                        <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                            <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>

                            <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                <div class="dropdown-inner">
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        {{ __('Acción') }}
                                    </div>
                                    <a href="{{ route('noticias.edit',[Crypt::encrypt($datos->id_noticia)]) }}" class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                        {{ __('Editar') }}
                                    </a>
                                    <a onclick="delete_noticia('{{Crypt::encrypt($datos->id_noticia)}}');" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        {{ __('Eliminar') }}
                                    </a>
                                    <a href="#" data-toggle="collapse" data-target="#table-detail-{{$datos->id_noticia}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-info btn-a-lighter-info collapsed" title="Mostrar herramientas">
                                        <i class="fa fa-angle-down toggle-icon opacity-1 text-90"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
            <tr class="border-0 detail-row bgc-white">
                <td colspan="6" class="p-0 border-none brc-secondary-l2">
                    <div class="table-detail collapse" id="table-detail-{{$datos->id_noticia}}">
                        <div class="row">
                            <div class="col-sm-12 py-3">
                                <form autocomplete="off" method="GET" action="">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="card bcard border-1 brc-dark-l1">
                                            <div class="card-body p-0">
                                                <textarea id="editor-{{$datos->id_noticia}}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <script type="module">

                $(document).ready(function () {
                    ClassicEditor.create(document.querySelector('#editor-'+{{$datos->id_noticia}}), {
                        toolbar: [],
                        readOnly: true
                    })
                    .then(editor => {
                        editor.setData('{!! $datos->descripcion !!}');
                    })
                    .catch(error => {
                        console.error(error);
                    });

                });

            </script>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('componentes.paginacion')
    @endif
@endsection
