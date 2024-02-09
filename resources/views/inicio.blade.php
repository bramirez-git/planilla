@extends('Layouts.menu')

@section('page-content')
    <div class="row mt-2 mt-lg-4 pt-2">
        <div class="col-12 col-lg-6 mt-3 mt-lg-0">
            <div class="bcard card h-100">
                <div class="card-header brc-grey-l3 pb-2">
                    <h5 class="card-title mb-2 mb-md-0 text-120 text-grey-d3">
                        <i class="fas fa-chart-line text-primary-m2 mr-1 text-105"></i>
                        Colaboradores por planilla mensual
                    </h5>

                    <!-- dropdown menu -->
                    <div class="card-toolbar no-border" style="width: 100px;">
                        <select data-placeholder="Seleccione una fecha.." class="chosen-select form-control" id="filtroUserPlanillaMensual" name="filtroUserPlanillaMensual">
                            <option value="{{date("Y")}}" selected="selected">{{date("Y")}}</option>
                            @foreach($filtro_data as $data)
                                @if($data != date("Y"))
                                    <option value="{{ $data }}">{{ $data }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-body p-1 p-md-3 h-100 d-flex align-items-center">
                    <figure class="highcharts-figure">
                        <div id="container3"></div>
                        <p class="highcharts-description mt-5">
                            En el siguiente gráfico visualizas la cantidad de colaboradores que gestionas mes a mes en la empresa.
                        </p>
                    </figure>
                </div><!-- .card-body -->
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-3 mt-lg-0">
            <div class="bcard card h-100">
                <div class="card-header brc-grey-l3 pb-2">
                    <h5 class="card-title mb-2 mb-md-0 text-120 text-grey-d3">
                        <i class="fas fa-chart-line text-primary-m2 mr-1 text-105"></i>
                        Cobro de planilla mensual
                    </h5>

                    <!-- dropdown menu -->
                    <div class="card-toolbar no-border" style="width: 100px;">
                        <select class="chosen-select form-control"  id="filtroPlanillaMensual" name="filtroPlanillaMensual">
                            <option value="{{date("Y")}}" selected="selected">{{date("Y")}}</option>
                            @foreach($filtro_data as $data)
                                @if($data != date("Y"))
                                    <option value="{{ $data }}">{{ $data }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-body p-1 p-md-3 h-100 d-flex align-items-center">
                    <figure class="highcharts-figure">
                        <div id="container2"></div>
                        <p class="highcharts-description mt-5" >
                            En el siguiente indicador visualizas el gasto bruto que la empresa asume por mes relacionados a pagos de planilla, cargas sociales del colaborador y del patrono como un todo.
                        </p>
                    </figure>
                </div><!-- .card-body -->
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row mt-2 mt-lg-4 pt-2">
        <!-- sale stats chart -->
        <div class="col-12 col-lg-6 mt-3 mt-lg-0">
            <div class="bcard card h-100">
                <div class="card-header brc-grey-l3 pb-2">
                    <h5 class="card-title mb-2 mb-md-0 text-120 text-grey-d3">
                        <i class="fas fa-chart-line text-primary-m2 mr-1 text-105"></i>
                        Cobro de aguinaldos planilla mensual
                    </h5>

                    <!-- dropdown menu -->
                    <div class="card-toolbar no-border" style="width: 100px;">
                        <select data-placeholder="Seleccione una fecha.." class="chosen-select form-control" id="filtroAgunaldos" name="filtroAgunaldos">
                            <option value="{{date("Y")}}" selected="selected">{{date("Y")}}</option>
                            @foreach($filtro_data as $data)
                                @if($data != date("Y"))
                                    <option value="{{ $data }}">{{ $data }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-body p-1 p-md-3 h-100 d-flex align-items-center">
                    <figure class="highcharts-figure">
                        <div id="containerAgunaldo"></div>
                        <p class="highcharts-description mt-5">
                            En el siguiente indicador visualizas el gasto bruto que la empresa asume por mes relacionados a aguinaldos.
                        </p>
                    </figure>
                </div><!-- .card-body -->
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-3 mt-lg-0">
            <div class="bcard card h-100">
                <div class="card-header brc-grey-l3 pb-2">
                    <h5 class="card-title mb-2 mb-md-0 text-120 text-grey-d3">
                        <i class="fas fa-chart-line text-primary-m2 mr-1 text-105"></i>
                        Tipo de ocupaciones CCSS
                    </h5>
                    <!-- dropdown menu -->
                    {{--                    <div class="card-toolbar no-border" style="width:100px;">--}}
                    {{--                        <select data-placeholder="Seleccione una fecha.." class="chosen-select form-control" id="tipoIdentificacion" name="tipoIdentificacion">--}}
                    {{--                            <option value="{{date("Y")}}" selected="selected">{{date("Y")}}</option>--}}
                    {{--                            @foreach($filtro_data as $data)--}}
                    {{--                                <option value="{{$data}}">{{$data}}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}
                </div>

                <div class="card-body p-1 p-md-3 h-100 d-flex align-items-center">
                    <figure class="highcharts-figure">
                        <div id="container1129"></div>
                        <p class="highcharts-description mt-5">
                            Ilustra el porcentaje de ocupaciones según la categorización de ocupaciones del Caja Costarricense de Seguro Social que tu empresa tiene asignado
                        </p>
                    </figure>
                </div><!-- .card-body -->
            </div>
        </div>
    </div>
    <br>
    <div class="row mt-2 mt-lg-4 pt-2">
        <!-- revenue/expense bar chart -->
        <div class="col-12 col-lg-6 mt-3 mt-lg-0">
            <div class="bcard card h-100">
                <div class="card-header brc-grey-l3 pb-2">
                    <h5 class="card-title mb-2 mb-md-0 text-120 text-grey-d3">
                        <i class="fas fa-chart-line text-primary-m2 mr-1 text-105"></i>
                        Tipo de ocupaciones INS
                    </h5>

{{--                    <!-- dropdown menu -->--}}
{{--                    <div class="card-toolbar no-border" style="width: 100px;">--}}
{{--                        <select data-placeholder="Seleccione una fecha.." class="chosen-select form-control" id="tipoIdentificacion" name="tipoIdentificacion">--}}
{{--                            <option value="{{date("Y")}}" selected="selected">{{date("Y")}}</option>--}}
{{--                            @foreach($filtro_data as $data)--}}
{{--                                <option value="{{$data}}">{{$data}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
                </div>

                <div class="card-body p-1 p-md-3 h-100 d-flex align-items-center">
                    <figure class="highcharts-figure">
                        <div id="container4"></div>
                        <p class="highcharts-description mt-5">
                            Ilustra el porcentaje de ocupaciones según la categorización de ocupaciones del Instituto Nacional de Seguros que tu empresa tiene asignado.
                        </p>
                    </figure>
                </div><!-- .card-body -->
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
@endsection

@push("scripts")
    <script type="module">
        $('.input-daterange').datepicker({
            format: 'yyyy', // Solo año
            minViewMode: 2, // Establece el nivel de visualización mínimo a años
            autoclose: true,
            calendarWeeks: true,
            clearBtn: true,
            orientation: 'bottom',
            disableTouchKeyboard: true,
            language: 'es'
        });

        $('#filtro_user_planilla_mensual').val(obtenerFechaEnFormatoYYYY);
        $('#filtro_ocupaciones_INS').val(obtenerFechaEnFormatoYYYY());
        $('#filtro_planilla_mensual').val(obtenerFechaEnFormatoYYYY);
        $('#filtro_ocupaciones_CCSS').val(obtenerFechaEnFormatoYYYY());
        function obtenerFechaEnFormatoYYYY() {
            var fecha = new Date();
            var ano = fecha.getFullYear();
            return ano.toString();
        }

        // Establecer el año actual en el formato 'yyyy' en el elemento con id 'fechaIngreso'

        Highcharts.setOptions({
            lang: {
                loading: 'Cargando...',
                months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                exportButtonTitle: "Exportar",
                printButtonTitle: "Importar",
                rangeSelectorFrom: "Desde",
                rangeSelectorTo: "Hasta",
                rangeSelectorZoom: "Período",
                downloadPNG: 'Descargar imagen PNG',
                downloadJPEG: 'Descargar imagen JPEG',
                downloadPDF: 'Descargar imagen PDF',
                downloadSVG: 'Descargar imagen SVG',
                printChart: 'Imprimir',
                resetZoom: 'Reiniciar zoom',
                resetZoomTitle: 'Reiniciar zoom',
                thousandsSep: ",",
                decimalPoint: '.',
                viewFullscreen: 'Ver en pantalla completa',
                exitFullscreen: 'Cerrar pantalla completa',
                downloadCSV:'Descargar CSV',
                downloadXLS:'Descargar XLS',
                viewData:'Ver como tabla',
                hideData:'Ocultar tabla'
            }
        });
    </script>
@endpush
