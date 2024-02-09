@extends('Layouts.menuPanel')

@section('page-content')

    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">

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
                                    <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" id="frm_filtros" action="{{route('clientes.index')}}">
                                        @csrf
                                        <input type="text" value="{{ route('clientes.index') }}" hidden name="url"/>
                                        <div class="dropdown-body my-25 px-3">
                                            <div class="px-2 px-md-3">
                                                <input type="text" id="buscar" value="{{ $buscar ?? '' }}" name="buscar" class="form-control" placeholder="Buscar ..."/>
                                            </div>
                                            <hr class="brc-default-l3"/>
                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4 text-nowrap">Tipo:</div>
                                                @foreach($result_tipo_empresa as $datos)
                                                <label class="mr-2 text-nowrap">
                                                    <input type="checkbox" class="mr-2" value="{{ $datos->id_tipo_empresa }}" @if(in_array($datos->id_tipo_empresa, $tipos_empresa)) checked @endif name="filtro[tipos_empresa][]"/>
                                                    {{ $datos->nombre }}
                                                </label>
                                                @endforeach

                                            </div>
                                            <hr class="brc-default-l3"/>
                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4 text-nowrap">Estado:</div>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round mr-1">
                                                        <input type="radio" name="filtro[estado]" @if($estado=="activo") checked  @endif value="activo"> Activo
                                                    </label>
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round mr-1">
                                                        <input type="radio" name="filtro[estado]" @if($estado=="inactivo") checked  @endif value="inactivo"> Inactivo
                                                    </label>
                                                    <label class="btn btn-sm px-425 btn-lighter-default btn-a-blue border-2 radius-round">
                                                        <input type="radio" name="filtro[estado]" id="estado_todos" @if($estado=="") checked  @endif value=""> Todos
                                                    </label>
                                                </div>
                                            </div>
                                            <hr class="brc-default-l3"/>
                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4 text-nowrap">Teléfono:</div>
                                                <input type="text" id="telefono" value="{{ $telefono }}" name="filtro[telefono]" class="form-control" placeholder="Teléfono"/>
                                            </div>
                                            <hr class="brc-default-l3"/>
                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4 text-nowrap">Correo empresa:</div>
                                                <input type="text" id="correoEmpresa" value="{{ $correo_empresa }}" name="filtro[correo_empresa]" class="form-control" placeholder="Correo Empresa"/>
                                            </div>
                                            <hr class="brc-default-l3"/>
                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4 text-nowrap">Correo contacto:</div>
                                                <input type="text" id="correoContacto" value="{{ $correo_contacto }}" name="filtro[correo_contacto]" class="form-control" placeholder="Correo Contacto"/>
                                            </div>
                                            <hr class="brc-default-l3"/>
                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4 text-nowrap">Fecha ingreso</div>
                                                <div class="input-group input-daterange">
                                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" placeholder="Desde" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaIngreso" name="filtro[fecha_ingreso]" value="{{ $fecha1 }}"/>
                                                </div>
                                                <label class="m-2">-</label>
                                                <div class="input-group input-daterange">
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
                        <a href="{{route('clientes.index')}}" onclick="waitingDialog.show();" class="btn btn-outline-green radius-1 d-inline-flex align-items-center h-100 btn-modal-cargando">
                            <i class="nav-icon fa fa-retweet"></i>
                        </a>
                    </div>
                    @if(!$resultado->isEmpty())
                        <div class="px-1">
                            <button id="descarga_excel_cliente" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                            <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>
                            </span>
                                Exportar excel
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if($resultado->isEmpty())
        <div class="alert alert-warning">
            No se encuentran registros
        </div>
    @else

    <div class="table-responsive border-t-3 brc-blue-m2">

        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th class="text-center text-secondary-d2 text-95 text-600">
                    Nombre del cliente
                </th>

                <th class="text-center text-secondary-d2 text-95 text-600">
                    Identificaci&oacute;n
                </th>

                <th class="d-none d-sm-table-cell text-center text-secondary-d2 text-95 text-600">
                    Correo
                </th>

                <th class='d-none d-sm-table-cell text-center text-secondary-d2 text-95 text-600'>
                    Teléfono
                </th>

                <th class="d-none d-sm-table-cell text-center text-secondary-d2 text-95 text-600">
                    Cantidad de colaboradores
                </th>

                <th class="d-none d-sm-table-cell text-center text-secondary-d2 text-95 text-600">
                    Saldo actual
                </th>

                <th class="d-none d-sm-table-cell text-center text-secondary-d2 text-95 text-600">
                    Estado
                </th>

                <th  class="text-left text-secondary-d2 text-95 text-600">
                    Acción
                </th>
            </tr>
            </thead>

            <tbody class="mt-1">
            @foreach($resultado as $datos)
            <tr class="bgc-h-blue-l4 d-style">
                <td class="text-center">
                    <a href='#' class='text-secondary-d2 text-95 text-600'>


                                   <span class="text-95 text-primary-d2 p-1 text-capitalize">
                           <strong>   {{ $datos->nombre}}</strong>
                        </span>
                        <div class="text-85 text-secondary-d1 text-capitalize px-0 mt-1">
                            {{ $datos->nombre_fantasia}}
                        </div>
                    </a>
                </td>

                <td class='text-grey-d1 text-center'>
                    {{ $datos->identificacion}}
                </td>

                <td class='d-none d-sm-table-cell text-grey-d1 align-middle text-center'>
                    {{ $datos->correo}}
                </td>

                <td class='d-none d-sm-table-cell text-center align-middle text-center'>
                    {{ $datos->telefono_fijo}}
                </td>

                <td class='d-none d-sm-table-cell text-center align-middle text-center'>
                    {{ $datos->total_colaboradores}}
                </td>

                <td class='d-none d-sm-table-cell text-center align-middle text-center'>
                    $  {{number_format($datos->monto_saldo, 2) ?? 0.00}}
                </td>

                <td class='text-grey text-95 text-center align-middle text-center'>
                    @if($datos->estado==="activo")
                        <span class="badge badge-sm text-white pb-1 px-25 bgc-success-d1">Activo</span>
                    @else
                        <span class="badge badge-sm text-white pb-1 px-25 bgc-danger-d1">Inactivo</span>
                    @endif
                </td>

                <td class=" align-middle">
                    <form method="POST" action="{{ route('clientes.destroy',[Crypt::encrypt($datos->id_empresa)]) }}">
                        @csrf
                        @method('DELETE')
                        <input type="text" value="{{ route('clientes.show', ':id') }}" hidden name="url_ajax"/>
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex float-left'>
                            <a data-encrypted-id="{{ Crypt::encrypt($datos->id_empresa) }}" href="{{ route('clientes.show',[Crypt::encrypt($datos->id_empresa)]) }}"  onclick="waitingDialog.show();" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success btn-ajax">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="#" data-toggle="collapse" data-target="#table-detail-{{$datos->id_empresa}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-info btn-a-lighter-info collapsed" title="Mostrar herramientas">
                                <i class="fa fa-angle-down toggle-icon opacity-1 text-90"></i>
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
                                    <a href="{{ route('clientes.show',[Crypt::encrypt($datos->id_empresa)]) }}" class="dropdown-item">
                                        <i class="fa fa-eye text-blue mr-1 p-2 w-4"></i>
                                        {{ __('Ver detalles') }}
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#dangerModal{{$datos->id_empresa}}" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        {{ __('Eliminar') }}
                                    </a>

                                    <a href="#" data-toggle="collapse" data-target="#table-detail-{{$datos->id_empresa}}" class="dropdown-item collapsed">
                                        <i class="fa fa-angle-down text-info-m1 mr-1 p-2 w-4"></i>
                                        {{ __('Mostrar herramientas') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" data-backdrop-bg="bgc-white" id="dangerModal{{$datos->id_empresa}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                                    <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                        <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel">
                                            ¡Atención!
                                        </h5>

                                        <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="text-150">&times;</span>
                                        </button>
                                    </div>


                                    <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                        <div class="d-flex align-items-top mr-2 mr-md-5">
                                            <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                            <div class="text-secondary-d2 text-105">
                                                ¿Está seguro que desea eliminar el cliente?
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer bgc-white-tp2 border-0">
                                        <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                            No
                                        </button>

                                        <button type="submit" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                            Si
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
            <tr class="border-0 detail-row bgc-white">
                <td colspan="6" class="p-0 border-none brc-secondary-l2">
                    <div class="table-detail collapse" id="table-detail-{{$datos->id_empresa}}">
                        <div class="row">
                            <div class="col-sm-12 py-3">
                                <form autocomplete="off" id="frm_activar_cuenta_{{$datos->id_empresa}}" method="POST" action="{{route('activar-cuenta')}}">
                                    @csrf
                                    @method('POST')
                                    <input type="text" value="{{$datos->correo}}" hidden name="data[correo]"/>
                                    <a id="{{$datos->id_empresa}}" title="re-envío notificación de activación" data-rel="tooltip" data-placement="auto" class="btn px-2 btn-lighter-primary font-bolder letter-spacing mb-1 submitLink btn-modal-cargando" style="margin-left: 20px;">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </a>
                                </form>
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
