@extends('Layouts.menu')

@section('page-content')



    <div class="row mb-475 align-content-start">
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-body bg-white p-0 h-100">
                    <div class="d-flex flex-row align-items-start align-items-lg-center justify-content-center h-100" >
                        <div class="row align-items-center">
                        <div class="p-x-4 px-lg-0 col-12 col-lg-5">
                            <img class="img-fluid w-75 m-auto d-block" src="{{ asset('img/imagenesReportes/ccss.svg') }}" />
                        </div>
                        <div class="p-x-2  col-12 col-lg-7">
                            <div class="p-3 text-justify">
                                <a href="#">
                                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                                        {{ __('CCSS') }}
                                    </h5>
                                </a>
                                <p>
                                    Reporte mensual en formato pdf con el salario bruto por colaborador vs.
                                    el mes anterior, y las observaciones que se deben reportar en el sitio
                                    WEB de CCSS de forma manual.

                                    <br><br>Además, en el caso de una planilla con más
                                    de 100 colaboradores se entrega un archivo para enviar directamente a CCSS.
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>



                <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-body bg-white p-0 h-100">
                    <div class="d-flex flex-row align-items-start align-items-lg-center justify-content-center h-100" >
                        <div class="row align-items-center">
                        <div class="p-x-4 px-lg-0 col-12 col-lg-5">
                            <img class="img-fluid w-75 m-auto d-block" src="{{ asset('img/imagenesReportes/ins.svg') }}" />
                        </div>
                        <div class="p-x-2  col-12 col-lg-7">
                            <div class="p-3 text-justify">
                                <a href="{{ route('reporte_INS') }}">
                                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                                          {{ __('INS') }}
                                    </h5>
                                </a>
                                <p>
                                        Reporte mensual para ser cargado directamente en el sitio WEB
                                    del INS con los salarios de cada colaborador y observaciones
                                    requeridas por el INS.
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


 <div class="row mb-475 align-content-start">
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-body bg-white p-0 h-100">
                    <div class="d-flex flex-row align-items-start align-items-lg-center justify-content-center h-100" >
                        <div class="row align-items-center">
                        <div class="p-x-4 px-lg-0 col-12 col-lg-5">
                            <img class="img-fluid w-75 m-auto d-block" src="{{ asset('img/imagenesReportes/renta.svg') }}" />
                        </div>
                        <div class="p-x-2  col-12 col-lg-7">
                            <div class="p-3 text-justify">
                                <a href="#">
                                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                                       {{ __('Renta') }}
                                    </h5>
                                </a>
                               <p>
                                    Reporte mensual con el monto total deducido a los colaboradores
                                    que deben pagar impuesto al salario menos las deducciones personales
                                    para crear la Declaración mensual D-103-1 de Retenciones de
                                    salario en la Fuente.
                                    <br><br>
                                    También, crea un reporte anual en el formato Excel para subir a la aplicación
                                    de Hacienda y crear la declaración informativa D-152.
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
         <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
             <div class="card bcard overflow-hidden h-100">
                 <div class="card-body bg-white p-0 h-100">
                     <div class="d-flex flex-row align-items-start align-items-lg-center justify-content-center h-100" >
                         <div class="row align-items-center">
                             <div class="p-x-4 px-lg-0 col-12 col-lg-5">
                                 <img class="img-fluid w-75 m-auto d-block" src="{{ asset('img/imagenesReportes/embargo.svg') }}" />
                             </div>
                             <div class="p-x-2  col-12 col-lg-7">
                                 <div class="p-3 text-justify">
                                     <a href="#">
                                         <h5 class="card-title text-110 text-primary-d2 pt-1">
                                             {{ __('Embargos y Pensiones Alimenticias') }}
                                         </h5>
                                     </a>
                                     <p>
                                         Reporte mensual con la información de deducciones de planilla
                                         por embargos y pensiones alimenticias para efectuar el pago el
                                         Banco BCR al Poder Judicial.
                                     </p>
                                 </div>
                             </div>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
    </div>

    <div class="row mb-475 align-content-start">


                <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-body bg-white p-0 h-100">
                    <div class="d-flex flex-row align-items-start align-items-lg-center justify-content-center h-100" >
                        <div class="row align-items-center">
                        <div class="p-x-4 px-lg-0 col-12 col-lg-5">
                            <img class="img-fluid w-75 m-auto d-block" src="{{ asset('img/imagenesReportes/vacaciones.svg') }}" />
                        </div>
                        <div class="p-x-2  col-12 col-lg-7">
                            <div class="p-3 text-justify">
                                <a href="#">
                                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                                           {{ __('Vacaciones') }}
                                    </h5>
                                </a>
                                <p>
                                  Reporte mensual de los días de vacaciones disfrutados y
                                    pagados a colaboradores para la contabilidad y recursos humanos.
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-body bg-white p-0 h-100">
                    <div class="d-flex flex-row align-items-start align-items-lg-center justify-content-center h-100" >
                        <div class="row align-items-center">
                            <div class="p-x-4 px-lg-0 col-12 col-lg-5">
                                <img class="img-fluid w-75 m-auto d-block" src="{{ asset('img/imagenesReportes/aguinaldo.svg') }}" />
                            </div>
                            <div class="p-x-2  col-12 col-lg-7">
                                <div class="p-3 text-justify">
                                    <a href="#">
                                        <h5 class="card-title text-110 text-primary-d2 pt-1">
                                            {{ __('Aguinaldos') }}
                                        </h5>
                                    </a>
                                    <p>
                                        Reporte anual con la información de pago y moneda totalizada, de diciembre
                                        de un año a noviembre del siguiente. Se presenta un reporte con la
                                        información correspondiente al aguinaldo de cada colaborador y la
                                        suma neta a pagar debido a adelanto de aguinaldo.

                                        <br><br>También se incluye
                                        en el mismo formato de la planilla un archivo para el banco designado
                                        para el pago correspondiente.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row mb-475 align-content-start">
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-body bg-white p-0 h-100">
                    <div class="d-flex flex-row align-items-start align-items-lg-center justify-content-center h-100" >
                        <div class="row align-items-center">
                        <div class="p-x-4 px-lg-0 col-12 col-lg-5">
                            <img class="img-fluid w-75 m-auto d-block" src="{{ asset('img/imagenesReportes/banco.svg') }}" />
                        </div>
                        <div class="p-x-2  col-12 col-lg-7">
                            <div class="p-3 text-justify">
                                <a href="#">
                                    <h5 class="card-title text-110 text-primary-d2 pt-1">
                                         {{ __('Bancos') }}
                                    </h5>
                                </a>
                                <p>
                                 Archivo mensual y de aguinaldo conforme al banco y moneda para cargar en el sitio WEB del Banco.
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-body bg-white p-0 h-100">
                    <div class="d-flex flex-row align-items-start align-items-lg-center justify-content-center h-100" >
                        <div class="row align-items-center">
                            <div class="p-x-4 px-lg-0 col-12 col-lg-5">
                                <img class="img-fluid w-75 m-auto d-block" src="{{ asset('img/imagenesReportes/prestamo.svg') }}" />
                            </div>
                            <div class="p-x-2  col-12 col-lg-7">
                                <div class="p-3 text-justify">
                                    <a href="#">
                                        <h5 class="card-title text-110 text-dark pt-1">
                                            <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Este reporte no está disponible, debe contratarse en el marketplace.">
                                                <i class="fa-solid fa-circle-info blue"></i>
                                            </span>
                                            {{ __('Préstamos') }}
                                        </h5>
                                    </a>
                                    <p>
                                        Reporte mensual de las deducciones a colaboradores por préstamos recibidos.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row mb-475 align-content-start">
        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cards-container">
            <div class="card bcard overflow-hidden h-100">
                <div class="card-body bg-white p-0 h-100">
                    <div class="d-flex flex-row align-items-start align-items-lg-center justify-content-center h-100" >
                        <div class="row align-items-center">
                            <div class="p-x-4 px-lg-0 col-12 col-lg-5">
                                <img class="img-fluid w-75 m-auto d-block" src="{{ asset('img/imagenesReportes/asiento_contable.svg') }}" />
                            </div>
                            <div class="p-x-2  col-12 col-lg-7">
                                <div class="p-3 text-justify">
                                    <a href="#">
                                        <h5 class="card-title text-110 text-dark pt-1">
                                            <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Este reporte no está disponible, debe contratarse en el marketplace.">
                                                <i class="fa-solid fa-circle-info blue"></i>
                                            </span>
                                            {{ __('Asiento contable') }}
                                        </h5>
                                    </a>
                                    <p>
                                        Reporte mensual con la información contable de
                                        planillas para la contabilidad de la empresa.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
