@extends('Layouts.menu')


@section('page-content')
    @if(isset($errorMessage))
        <div role="alert" class="alert alert-warning bgc-warning-l4 brc-warning-m3 border-2 d-flex align-items-center">
            <i class="fas fa-exclamation-circle mr-3 fa-2x text-orange"></i>
            <div class="text-dark-tp2">
                {{$errorMessage}}.
                <br>
                Ir a
                <a href="{{ route('administracionEmpresa.edit',[Crypt::encrypt(session()->get("id_cliente"))]) }}" class="alert-link text-orange-d2">
                    configuración de empresa.
                </a>
            </div>
        </div>
    @else
        <div class="d-flex flex-column flex-md-row justify-content-center">
            <div class="mb-4 w-100">
                @foreach($resultado as $resultadoPlanillas)
                    <div class="d-style btn bgc-white btn-light btn-h-outline-{{$resultadoPlanillas->color}} btn-a-outline-{{$resultadoPlanillas->color}} w-100 border-t-3 my-2 pb-3 shadow-sm">
                        <!-- Basic Plan -->
                        <div class="row align-items-center d-zoom-1">
                            <div class="col-12 col-md-1 ml-5">
                                @if($resultadoPlanillas->moneda == "colones")
                                    <i class="fa fa-colon-sign fa-2x text-{{$resultadoPlanillas->color}}"></i>
                                @else
                                    <i class="fa fa-dollar fa-2x text-{{$resultadoPlanillas->color}}"></i>
                                @endif
                            </div>
                            <div class="col-12 col-md-3">
                                <h4 class="pt-3 text-170 text-600 text-{{$resultadoPlanillas->color}}-d1 letter-spacing">
                                    {{ $resultadoPlanillas->nombre }}
                                    @if($resultadoPlanillas->adelanto=='si')
                                        <!-- con adelanto. -->
                                    @endif
                                </h4>

                                <div class="text-secondary-d1 text-130">
                                    @if(in_array($resultadoPlanillas->periodo, array("primer_quincena", "segunda_quincena")))
                                        @switch($resultadoPlanillas->periodo)
                                            @case("primer_quincena")
                                                Adelanto
                                                @break;
                                            @case("segunda_quincena")
                                                Cierre
                                                @break
                                        @endswitch
                                    @endif
                                    {{ ucfirst($resultadoPlanillas->nombre_periodo) }}
                                </div>
                            </div>

                            <ul class="list-unstyled mb-0 col-12 col-md-4 text-dark-l1 text-90 text-left my-4 my-md-0">
                                <!-- Texto 1 -->
                                <li class="mt-25">
                                    <i class="fa fa-check text-{{$resultadoPlanillas->color}} text-110 mr-2 mt-1"></i>
                                    <span class="text-120 text-{{$resultadoPlanillas->color}}">
                                        @if($resultadoPlanillas->codigo == "NME")
                                            @if($resultadoPlanillas->adelanto == "si")
                                                Planilla Mensual Con Adelanto
                                            @else
                                                Planilla Mensual Sin Adelanto
                                            @endif
                                        @else
                                            Planilla Semanal
                                        @endif
                                    </span>
                                </li>

                                <!-- Texto 2 -->
                                <li class="mt-25">
                                    <i class="fa fa-check text-{{$resultadoPlanillas->color}} text-110 mr-2 mt-1"></i>
                                    <span class="text-120 text-{{$resultadoPlanillas->color}}">
                                        @if($resultadoPlanillas->codigo == "NME")
                                            @if($resultadoPlanillas->adelanto == "si")
                                                @if($resultadoPlanillas->periodo == "primer_quincena")
                                                    Porcentaje adelanto: {{ $resultadoPlanillas->porcentaje_salario_adelanto }}%
                                                @else
                                                    Porcentaje cierre: {{ 100 - $resultadoPlanillas->porcentaje_salario_adelanto }}%
                                                @endif
                                            @else
                                                Porcentaje planilla: 100%
                                            @endif
                                        @else
                                            Planilla Semanal
                                        @endif
                                    </span>
                                </li>

                                <!-- Texto 3 -->
                                <li class="mt-25">
                                    <i class="fa fa-check text-{{$resultadoPlanillas->color}} text-110 mr-2 mt-1"></i>
                                    <span class="text-120 text-{{$resultadoPlanillas->color}}">
                                        @if($resultadoPlanillas->codigo == "NME")
                                            @if($resultadoPlanillas->adelanto == "si")
                                                @if($resultadoPlanillas->aplicar_cargas_renta_adelanto == "si")
                                                    Aplicar cargas sociales y renta en adelanto
                                                @else
                                                    No aplicar cargas sociales y renta en adelanto
                                                @endif
                                            @else
                                                Cargas sociales y renta: 100%
                                            @endif
                                        @else
                                            Planilla Semanal
                                        @endif
                                    </span>
                                </li>
                            </ul>

                            <div class="col-12 col-md-3 text-center mt-2">
                                @php
                                    if($resultadoPlanillas->id_planilla == 0){
                                        @endphp
                                            @if($resultadoPlanillas->periodo=='semanal')
                                                <a href="{{route('generarPlanilla.crear',[Crypt::encrypt($resultadoPlanillas->id_tipo_planilla),Crypt::encrypt($resultadoPlanillas->id_moneda)])}}" class="f-n-hover btn btn-{{$resultadoPlanillas->color}} btn-raised px-4 py-25 w-75 text-600 mb-2">
                                                    <!-- Crear planilla semanal -->
                                                    Crear planilla
                                                </a>
                                            @else
                                                @if($resultadoPlanillas->periodo=='primer_quincena')
                                                <a href="{{route('generarPlanilla.crear',[Crypt::encrypt($resultadoPlanillas->id_tipo_planilla),Crypt::encrypt($resultadoPlanillas->id_moneda)])}}" class="f-n-hover btn btn-{{$resultadoPlanillas->color}} btn-raised px-4 py-25 w-75 text-600 mb-2">
                                                    <!-- Generar adelanto de planilla -->
                                                    Crear planilla
                                                </a>
                                                @else
                                                <a href="{{route('generarPlanilla.crear',[Crypt::encrypt($resultadoPlanillas->id_tipo_planilla),Crypt::encrypt($resultadoPlanillas->id_moneda)])}}" class="f-n-hover btn btn-{{$resultadoPlanillas->color}} btn-raised px-4 py-25 w-75 text-600">
                                                    <!-- Crear la planilla cierre mensual -->
                                                    Crear planilla
                                                </a>
                                                @endif
                                            @endif
                                        @php
                                    }
                                    else
                                    {
                                        @endphp

                                        @if($resultadoPlanillas->periodo=='semanal')
                                            <a href="{{route('generarPlanilla.crear',[Crypt::encrypt($resultadoPlanillas->id_tipo_planilla),Crypt::encrypt($resultadoPlanillas->id_moneda)])}}" class="f-n-hover btn btn-{{$resultadoPlanillas->color}} btn-raised px-4 py-25 w-75 text-600 mb-2">
                                                <!-- Continuar planilla semanal -->
                                                Continuar planilla
                                            </a>
                                        @else
                                            @if($resultadoPlanillas->periodo=='primer_quincena')
                                                <a href="{{route('generarPlanilla.edit',[Crypt::encrypt($resultadoPlanillas->id_planilla)])}}" class="f-n-hover btn btn-{{$resultadoPlanillas->color}} btn-raised px-4 py-25 w-75 text-600 mb-2">
                                                    <!-- Continuar adelanto de planilla -->
                                                    Continuar planilla
                                                </a>
                                            @else
                                                <a href="{{route('generarPlanilla.edit',[Crypt::encrypt($resultadoPlanillas->id_planilla)])}}" class="f-n-hover btn btn-{{$resultadoPlanillas->color}} btn-raised px-4 py-25 w-75 text-600">
                                                    <!-- Continuar la planilla cierre mensual -->
                                                    Continuar planilla
                                                </a>
                                            @endif
                                        @endif

                                        <button type="button" data-toggle="modal" data-target="#dangerModal{{$resultadoPlanillas->id_planilla}}"  class="btn btn-grey btn-h-danger btn-a-danger btn-text-slide-y px-4 py-25 w-75 text-600 mt-2">
                                            <i class="fa fa-trash-alt text-130 px-2 btn-text-1 mt-1"></i>
                                            <span class="text-95 text-600 btn-text-2">
                                                Desechar
                                            </span>
                                        </button>
                                        @php
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('generarPlanilla.destroy',[Crypt::encrypt($resultadoPlanillas->id_planilla)]) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal fade" data-backdrop-bg="bgc-white" id="dangerModal{{$resultadoPlanillas->id_planilla}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
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
                                                ¿Está seguro que desea desechar la planilla?
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
                @endforeach
            </div>
        </div>
    @endif

@endsection
