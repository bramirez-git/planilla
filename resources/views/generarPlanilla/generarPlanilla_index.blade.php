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
                                    @if($resultadoPlanillas->adelanto == 'si')
                                        <!-- con adelanto. -->
                                    @endif
                                </h4>

                                <div class="text-secondary-d1 text-130">
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
                                                <a href="{{route('generarPlanilla.crear',[Crypt::encrypt($resultadoPlanillas->id_tipo_planilla),Crypt::encrypt($resultadoPlanillas->id_moneda)])}}" class="f-n-hover btn btn-{{$resultadoPlanillas->color}} btn-raised px-4 py-25 w-75 text-600">
                                                    <!-- Crear la planilla cierre mensual -->
                                                    Crear planilla
                                                </a>
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
                                            <div class="d-flex bd-highlight">
                                                <div class="p-2 flex-grow-1 bd-highlight">
                                                    @if($resultadoPlanillas->adelanto=='si')
                                                        <div class="d-flex flex-column" >
                                                            <div class="mb-auto p-2 bd-highlight align-self-center">
                                                                @if($resultadoPlanillas->cierre_auxiliar == 1)
                                                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Adelanto de planilla, se encuentra cerrado">
                                                                      <button class="btn btn-secondary f-n-hover btn-raised px-4 py-25 text-600 mb-2 disabled" style="pointer-events: none;" type="button" disabled>Adelanto de planilla</button>
                                                                    </span>
                                                                @else
                                                                    <a href="{{route('generarAdelantoPlanilla.edit',[Crypt::encrypt($resultadoPlanillas->id_planilla)])}}" class="f-n-hover btn btn-{{$resultadoPlanillas->color}} btn-raised px-4 py-25 text-600 mb-2 ">
                                                                        Adelanto de planilla
                                                                    </a>
                                                                @endif
                                                            </div>
                                                    @endif
                                                        <div class="mb-auto p-2 bd-highlight align-self-center">
                                                            <a href="{{route('generarPlanilla.edit',[Crypt::encrypt($resultadoPlanillas->id_planilla)])}}" class="f-n-hover btn btn-{{$resultadoPlanillas->color}} btn-raised px-4 py-25 text-600 mb-2">
                                                                Continuar la planilla
                                                            </a>
                                                        </div>

                                                    @if($resultadoPlanillas->adelanto=='si')
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="p-2 bd-highlight align-self-center">
                                                    <a data-toggle="modal" id="btn-delete-planilla" class="btn btn-grey btn-h-danger btn-a-danger px-3 btn-text-slide-y pt-2 pb-3 mb-2">
                                                        <i class="fa fa-trash-alt text-130 px-2 btn-text-1 mt-1"></i>
                                                        <span class="text-95 text-600 btn-text-2">
                                                            Eliminar
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                        @php
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>
                    <form method="POST" id="frm-destroy-planilla" action="{{ route('generarPlanilla.destroy',[Crypt::encrypt($resultadoPlanillas->id_planilla)]) }}">
                        @csrf
                    </form>
                @endforeach
            </div>
        </div>
    @endif

@endsection
