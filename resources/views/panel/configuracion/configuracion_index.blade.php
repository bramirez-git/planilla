@extends('Layouts.menuPanel')

@section('page-content')
    <div class="row mb-475">
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-header">
                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                        {{ __('Deducciones patronales por ley') }}
                    </h5>

                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0">
                    <div class="p-3 text-justify">
                        <p>
                            Configure en este apartado la información referente a los porcentajes
                            de deducciones patronales como porcentajes contributivos del asalariado
                            en construcción.
                        </p>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-between">
                    <a href="{{ route('configuracionDeduccionPatronal.edit',[Crypt::encrypt('1234')]) }}" class="btn border-2 btn-lighter-primary btn-text-black btn-h-primary btn-a-primary btn-bgc-tp">
                        Configurar
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-header">
                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                        {{ __('Impuestos de renta') }}
                    </h5>
                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0">
                    <div class="p-3 text-justify">
                        <p>
                            Configure en este apartado la información referente a los
                            rangos de los tramos de deducciones de renta establecidos
                            por el Ministerio de Hacienda.
                        </p>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-between">
                    <a href="{{ route('configuracionImpuestosRenta.edit',[Crypt::encrypt('12345')]) }}" class="btn border-2 btn-lighter-primary btn-text-black btn-h-primary btn-a-primary btn-bgc-tp">
                        Configurar
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-475">
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-header">
                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                        {{ __('Créditos Fiscales Familiares') }}
                    </h5>

                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0">
                    <div class="p-3 text-justify">
                        <p>
                            Configure en este apartado la información referente a los
                            créditos fiscales relacionados a cónyuge e hijos del asalariado
                            establecidos por el Ministerio de Hacienda.
                        </p>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-between">
                    <a href="{{ route('configuracionCreditoFamiliar.edit',[Crypt::encrypt('12345')]) }}" class="btn border-2 btn-lighter-primary btn-text-black btn-h-primary btn-a-primary btn-bgc-tp">
                        Configurar
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-header">
                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                        {{ __('Configuración de catálogo de entidades financieras') }}
                    </h5>
                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0">
                    <div class="p-3 text-justify">
                        <p>
                            Configure en este apartado la información referente a las Entidades
                            Bancarias disponibles que el sistema utilizará para generar los archivos
                            de planilla u otras opciones Bancarias.
                        </p>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-between">
                    <a href="{{ route('configuracionEntidadesFinancieras.edit',[Crypt::encrypt('12345')]) }}" class="btn border-2 btn-lighter-primary btn-text-black btn-h-primary btn-a-primary btn-bgc-tp">
                        Configurar
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-475">
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-header">
                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                        {{ __('Catálogo de ocupaciones INS') }}
                    </h5>

                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0">
                    <div class="p-3 text-justify">
                        <p>
                            Basado en el Manual de Perfiles ocupacionales de SUGESE -
                            Vigente a partir del 01 de Enero del 2020.
                        </p>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-between">
                    <a href="{{ route('configuracionCatalogoINS.index') }}" class="btn border-2 btn-lighter-primary btn-text-black btn-h-primary btn-a-primary btn-bgc-tp">
                        Configurar
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-header">
                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                        {{ __('Establecer el Salario Mínimo') }}
                    </h5>

                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0">
                    <div class="p-3 text-justify">
                        <p>
                            Configuración del Salario Mínimo establecido por el el Ministerio
                            de Trabajo y Seguridad Social (MTSS) para utilizar en cálculos de
                            montos embargos y que se establecen por orden judicial, ante una
                            deuda u obligación con la justicia.
                        </p>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-between">
                    <a href="{{ route('configuracionSalarioMinimo.edit',[Crypt::encrypt('12345')]) }}" class="btn border-2 btn-lighter-primary btn-text-black btn-h-primary btn-a-primary btn-bgc-tp">
                        Configurar
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-475">
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-header">
                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                        {{ __('Catálogo de ocupaciones CCSS') }}
                    </h5>

                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0">
                    <div class="p-3 text-justify">
                        <p>
                            Basado en el Manual de Perfiles ocupacionales de SUGESE -
                            Vigente a partir del 01 de Enero del 2020.
                        </p>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-between">
                    <a href="{{ route('configuracionCatalogoCCSS.index') }}" class="btn border-2 btn-lighter-primary btn-text-black btn-h-primary btn-a-primary btn-bgc-tp">
                        Configurar
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-header">
                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                        {{ __('Catálogo de acciones de personal') }}
                    </h5>

                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0">
                    <div class="p-3 text-justify">
                        <p>
                            Acciones de personal que van a tener disponibles las empresas para
                            asignar a sus colaboradores.
                        </p>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-between">
                    <a href="{{ route('configuracionAccionPersonal.index') }}" class="btn border-2 btn-lighter-primary btn-text-black btn-h-primary btn-a-primary btn-bgc-tp">
                        Configurar
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-475">
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-header">
                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                        {{ __('Catálogo de dias Festivos') }}
                    </h5>

                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0">
                    <div class="p-3 text-justify">
                        <p>
                            Registro de dias festivos según los establecidos por la ley o bien los emitidos por el
                            gobierno de la república de Costa Rica.
                        </p>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-between">
                    <a href="{{ route('configuracionCatalogoFeriados.index') }}" class="btn border-2 btn-lighter-primary btn-text-black btn-h-primary btn-a-primary btn-bgc-tp">
                        Configurar
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-header">
                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                        {{ __('Padrón completo') }}
                    </h5>

                </div><!-- /.card-header -->

                <div class="card-body bg-white p-0">
                    <div class="p-3 text-justify">
                        <p>
                            Permite subir la información del padrón completo del país.
                        </p>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-between">
                    <a href="{{ route('configuracionPadronCompleto.index') }}" class="btn border-2 btn-lighter-primary btn-text-black btn-h-primary btn-a-primary btn-bgc-tp">
                        Configurar
                        <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
