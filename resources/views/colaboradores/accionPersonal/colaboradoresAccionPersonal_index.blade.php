@extends('Layouts.menu')

@section('page-content')

    @if($resultadoAcciones->isEmpty())

        <div class="d-flex flex-column flex-md-row justify-content-between">
            <div class="text-nowrap align-self-start mb-sm-0 pb-4">
                <form autocomplete="off" method="GET" action="{{ route('colaboradorAccionPersonal.create') }}">
                    <input type="text" value="{{Crypt::encrypt($idColaborador)}}" hidden name="id_colaborador"/>
                    <button type="submit" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                    <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                                </span>
                        Agregar Acción Personal
                    </button>
                </form>
            </div>
        </div>

        <div class="alert alert-warning">
            La lista de acciones de personal asignadas al colaborador, está vacía.
        </div>
    @else

        <div class="d-flex flex-column flex-md-row justify-content-between">
            <div class="text-nowrap align-self-start mb-sm-0 pb-4">

                <form autocomplete="off" method="GET" action="{{ route('colaboradorAccionPersonal.create') }}">
                    <input id="id_colaborador" type="text" value="{{Crypt::encrypt($idColaborador)}}" hidden name="id_colaborador"/>
                    <button type="submit" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                    <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                                </span>
                        Agregar Acción Personal
                    </button>
                </form>
            </div>

            <div class="text-nowrap align-self-start pl-md-2">
                <div class="d-inline-flex align-items-center ml-sm-0  mr-1 pb-4">
                    <button id="descarga_excel_colaborador_accion_personal" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                            <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>
                            </span>
                        Exportar excel
                    </button>
                </div>
            </div>
        </div>


        <div class="table-responsive">

            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                    <tr>
                         <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                            Tipo de acción
                        </th>

                        <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                            Cantidad de días
                        </th>

                        <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                            Fecha de registro de acción
                        </th>

                         <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                            Acción
                        </th>
                    </tr>
                </thead>

                <tbody class="mt-1">
                    @foreach($resultadoAcciones as $acciones)
                        <tr class="bgc-h-blue-l4 d-style">
                            <td data-label="Tipo de acción:" class='text-grey-d1 text-right text-md-center'>
                                {{mb_strtoupper($acciones->nombre_subcategoria)}}
                            </td>
                            <td data-label="Tipo de acción:" class='text-grey-d1 text-right text-md-center'>
                                <a onClick="modal_consulta_dias('{{ Crypt::encrypt($idColaborador) }}', '{{Crypt::encrypt($acciones->id_accion_personal) }}', '{{ $acciones->nombre_colaborador }}' );" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">{{ $acciones->cantidad_dias }} </a>
                            </td>
                            <td data-label="Tipo de acción:" class='text-grey-d1 text-right text-md-center'>
                                {{ date_format(date_create(substr($acciones->created_at, 0, 10)),"d/m/Y") }}
                            </td>
                            <td data-label="Acción:" class='text-grey-d1 text-right text-md-center'>
                                <!-- action buttons -->
                                <div class='d-none d-lg-flex justify-content-center'>
                                    <a href="{{ route('colaboradorAccionPersonal.show',[Crypt::encrypt($acciones->id_accion_personal.'-'.$idColaborador)]) }}" title="Mostrar detalle de acción" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                        <i class="fa fa-eye"></i>
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
                                            <a href="{{ route('colaboradorAccionPersonal.show',[Crypt::encrypt($acciones->id_accion_personal.'-'.$idColaborador)]) }}" class="dropdown-item">
                                                <i class="fa fa-eye text-success mr-1 p-2 w-4"></i>
                                                {{ __('Mostrar detalle de acción') }}
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('componentes.paginacion')
    @endif
@endsection
