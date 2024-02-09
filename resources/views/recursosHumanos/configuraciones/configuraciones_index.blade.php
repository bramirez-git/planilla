@extends('Layouts.menu')

@section('page-content')

    <div class="row mb-475">
        <div class="col-12 col-lg-6 mt-3 mt-sm-0 cards-container">
            <div class="card bgc-primary-d3  bcard overflow-hidden h-100">
                <div class="card-header">
                    <h5 class="card-title text-110 text-white  pt-1">
                        {{ __('Configuración de solicitudes') }}
                    </h5>

                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0" h-100>
                    <div class="p-3 text-justify">
                        <p>
                            En esta sección puede configurar los diferentes tipos de Solicitudes que se
                            relacionan para poder clasificación cuando el colaborador realiza la solicitud
                            de vacaciones, incapacidades, permisos, licencias maternales, licencias paternas,
                            licencias matrimoniales, entre otras. En esta sección puede configurar los
                            diferentes tipos de Solicitudes que se relacionan para poder clasificación cuando
                            el colaborador realiza la solicitud de vacaciones, incapacidades, permisos,
                            licencias maternales, licencias paternas, licencias matrimoniales, entre otras.
                        </p>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-between">
                    <a href="{{ route('rh_configuracionTipoSolicitudes.index') }}" class="btn border-2 btn-lighter-primary btn-text-black btn-h-primary btn-a-primary btn-bgc-tp">
                        Configurar
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mt-3 mt-sm-0 cards-container">
            <div class="card bgc-primary-d3  bcard overflow-hidden h-100">
                <div class="card-header">
                    <h5 class="card-title text-110 text-white pt-1">
                        {{ __('Configuración de días festivos') }}
                    </h5>
                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0 h-100">
                    <div class="p-3 text-justify">
                        <p>
                            En esta sección puede configurar los días festivos, como feriados de Ley,
                            Feriados No Pagados, Fechas Especiales, Estas fechas con su texto descriptivo
                            se ve reflejado en Calendarios y Agendas del Sistema.
                        </p>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-between">
                    <a href="{{ route('rh_configuracionFeriados.index') }}" class="btn border-2 btn-lighter-primary btn-text-black btn-h-primary btn-a-primary btn-bgc-tp">
                        Configurar
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
