@extends('Layouts.menu')

@section('page-content')
    <h5 class="page-title text-dark-m2 text-140 text-success-l1">
        Información de Acción de personal
    </h5>

    <div class="row">
        <div class="col-12  col-xl-8 ">
            <div class="card bcard">
                <div class="card-body p-lg-4">

                    @if($resultadoAccion->abreviatura_categoria=="CONSTA")
                        @include('colaboradores.accionPersonal.formularios_show.formulario_constanciaSalario')
                    @elseif($resultadoAccion->abreviatura_categoria=="AMONES")
                        @include('colaboradores.accionPersonal.formularios_show.formulario_amonestaciones')
                    @elseif($resultadoAccion->abreviatura_categoria=="VACACI")
                        @include('colaboradores.accionPersonal.formularios_show.formulario_vacaciones')
                    @elseif($resultadoAccion->abreviatura_categoria=="LICENC")
                        @include('colaboradores.accionPersonal.formularios_show.formulario_licencias')
                    @elseif($resultadoAccion->abreviatura_categoria=="PERMIS")
                        @include('colaboradores.accionPersonal.formularios_show.formulario_permiso')
                    @elseif($resultadoAccion->abreviatura_categoria=="INCAPA")
                        @include('colaboradores.accionPersonal.formularios_show.formulario_incapacidad')
                    @elseif($resultadoAccion->abreviatura_categoria=="MODSAL")
                        @include('colaboradores.accionPersonal.formularios_show.formulario_modificacionSalarial')
                    @elseif($resultadoAccion->abreviatura_categoria=="TERCON")
                        @include('colaboradores.accionPersonal.formularios_show.formulario_terminacionContrato')
                    @endif

                    @if($resultadoAccion->abreviatura_categoria=="INCAPA" || $resultadoAccion->abreviatura_categoria=="AMONES"
                    || $resultadoAccion->abreviatura_subcategoria=="VACAG" || $resultadoAccion->abreviatura_categoria=="LICENC"
                    || $resultadoAccion->abreviatura_categoria=="PERMIS")
                        <div id='calendar-container'>
                            <div class="card bcard">
                                <div class="card-body p-lg-4">
                                    <div id='calendar' class="text-blue-d1"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12  col-xl-4  mt-3 mt-xl-0" id='external-events'>
            <div class="bgc-white shadow-sm p-35 radius-1">
                @if($resultadoAccion->abreviatura_categoria!="CONSTA" && $resultadoAccion->abreviatura_subcategoria!="AMOLEV"
                    && $resultadoAccion->abreviatura_categoria!="MODSAL" && $resultadoAccion->abreviatura_categoria!="TERCON")
                <form id="form-document" method="POST" enctype="multipart/form-data" action="{{route('subirArchivoAccionPersonal',[Crypt::encrypt($resultadoAccion->id_colaborador),Crypt::encrypt($resultadoAccion->id_accion_personal),Crypt::encrypt($resultadoAccion->categoria_documentos)])}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">  <p class="text-120 text-primary-d2">
                                Adjuntar archivo
                            </p></div>
                        <div class="col-12">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="documento" name="documento" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label selected" for="inputGroupFile01"></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" disabled id="subirArchivo" data-toggle="modal" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1 mt-4 ">
                                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                    <i class="fa fa-upload mr-1 text-white text-120 mt-3px"></i>
                                </span>
                                Subir archivo
                            </button>
                        </div>
                    </div>
                </form>
                @endif

                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="card-body p-3px bgc-blue-d2">
                            <div class="radius-1 table-responsive">
                                <table class="table table-striped table-bordered table-hover brc-black-tp10 mb-0 text-grey">
                                    <thead class="brc-transparent">
                                    <tr class="bgc-blue-d2 text-white">
                                        <th>
                                            Documentos adjuntos
                                        </th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @if($resultadoAccion->documentos!="")
                                        @php
                                            $documentos = explode(",", $resultadoAccion->documentos);
                                        @endphp

                                        @foreach($documentos as $documento)
                                            @php
                                                $nombreDocumento = explode("/",$documento);
                                                $nombreDocumento = $nombreDocumento[count($nombreDocumento)-1];
                                            @endphp
                                            <tr class="bgc-h-yellow-l3">
                                                <td class="text-600 text-dark">
                                                    {{$nombreDocumento}}
                                                </td>

                                                <td class="text-center">
                                                    <a href="{{route('descargarArchivo',[Crypt::encrypt($documento)])}}"  class="btn btn-danger btn-sm mb-1">
                                                        <i class="fa fa-file-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2">
                                                No hay archivos adjuntos
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div><!-- ./table-responsive -->
                        </div><!-- /.card-body -->
                    </div>
                </div>

            </div>

        </div>
    </div>


@endsection

@push('scripts')
    <script type="text/javascript">
        jQuery(function($) {
            if (!window.Intl) {
                console.log("Calendar can't be displayed because your browser doesn's support `Intl`. You may use a polyfill!");
                return;
            }

            $("#subirArchivo").on("click", function(e){

                e.preventDefault();

                var f = $(this);

                var formData = new FormData(document.getElementById("form-document"));

                $.ajax({

                    url: "{{route("subirArchivoAccionPersonal",[Crypt::encrypt($resultadoAccion->id_colaborador),Crypt::encrypt($resultadoAccion->id_accion_personal),Crypt::encrypt($resultadoAccion->categoria_documentos)])}}",
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(res){
                    if(res=="guardado")
                    {
                        mensaje_swal('Success', 'Se ha guardado el archivo correctamente.',function () { fn_reload(); } );
                    }
                    else{
                        mensaje_swal('Error', 'Ha sucedido un error al guardar el documento, intente de nuevo por favor.');
                    }
                })
            });


            //hide/show relevant alert messages according to device
            if('ontouchstart' in window) {
                $('#alert-1').removeClass('d-none')
                $('#alert-2').addClass('d-none')
            }


            // change styling options and icons
            FullCalendar.BootstrapTheme.prototype.classes = {
                root: 'fc-theme-bootstrap',
                table: 'table-bordered table-bordered brc-default-l2 text-secondary-d1 h-95',
                tableCellShaded: 'bgc-secondary-l3',
                buttonGroup: 'btn-group',
                button: 'btn btn-white btn-h-lighter-blue btn-a-blue',
                buttonActive: 'active',
                popover: 'card card-primary',
                popoverHeader: 'card-header',
                popoverContent: 'card-body',
            };
            FullCalendar.BootstrapTheme.prototype.baseIconClass = 'fa';
            FullCalendar.BootstrapTheme.prototype.iconClasses = {
                close: 'fa-times',
                prev: 'fa-chevron-left',
                next: 'fa-chevron-right',
                prevYear: 'fa-angle-double-left',
                nextYear: 'fa-angle-double-right'
            };
            FullCalendar.BootstrapTheme.prototype.iconOverrideOption = 'FontAwesome';
            FullCalendar.BootstrapTheme.prototype.iconOverrideCustomButtonOption = 'FontAwesome';
            FullCalendar.BootstrapTheme.prototype.iconOverridePrefix = 'fa-';



            //for some random events to be added
            var date = new Date();
            var m = date.getMonth();
            var y = date.getFullYear();

            var day1 = Math.random() * 20 + 2;
            var day2 = Math.random() * 25 + 1;

            @if($resultadoAccion->abreviatura_categoria!="CONST" && $resultadoAccion->abreviatura_categoria!="MODSA"
                && $resultadoAccion->abreviatura_categoria!="TERCO")
            // initialize the calendar
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                themeSystem: 'bootstrap',
                locale:'es',
                headerToolbar: {
                    start: 'prev,next today',
                    center: 'title',
                    end: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },

                //yellow, purple, orange,blue,red
                events: [

                        @if($resultadoAccion->tipo_fechas=="rango")
                            @foreach($fechasAccion as $fechas)
                                @php
                                    $rangoFechas = explode("|", $fechas["fecha"]);
                                @endphp
                            @endforeach
                            {
                                title: '{{$resultadoAccion->nombre_categoria.'-'.$resultadoAccion->nombre_subcategoria}}',
                                start:  '{{ $rangoFechas[0] }}',
                                end:  '{{ date("Y-m-d",strtotime(date($rangoFechas[1])."+ 1 day")) }}',
                                allDay: true,
                                className: 'bgc-{{$resultadoAccion->color}}-d2 text-white text-95'
                            },
                        @else
                        @foreach($fechasAccion as $fechas)
                    {
                        @php
                            $rangoFechas = explode("|", $fechas["fecha"]);
                        @endphp

                        title: '{{$resultadoAccion->nombre_categoria.'-'.$resultadoAccion->nombre_subcategoria}}',
                        start:  '{{ date_format(date_create($rangoFechas[0]),"Y-m-d") }}',
                        @if(count($rangoFechas)>1)
                        end:  '{{ date("Y-m-d",strtotime(date($rangoFechas[1])."+ 1 day")) }}',
                        @else

                            @endif
                        allDay: true,
                        className: 'bgc-{{$resultadoAccion->color}}-d2 text-white text-95',
                    },
                    @endforeach
                    @endif
                ],

                editable: false,
                eventClick: function(info) {

                    let id = info.event.id.split('-');

                    if(id[0]==2)
                    {
                        //display a modal
                        var modal =
                            '<div class="modal fade">\
                              <div class="modal-dialog">\
                         <div class="modal-content">\
                          <div class="modal-header">\
                            <h5 class="modal-title">Detalle de evento</h5>\
                            <button type="button" class="close" data-dismiss="modal">&times;</button>\
                          </div>\
                          <div class="modal-body">\
                            <form class="m-0">\
                              <div class="input-group">\
                                  <div class="input-groupp-repend align-self-center mr-2">\
                                    Nombre:\
                                  </div>\
                                  <input class="form-control" autocomplete="off" type="text" value="' + info.event.title + '" />\
                              </div>\
                                              <br>\
                            </form>\
                          </div>\
                              </div>\
                             </div>\
                            </div>';
                    }
                    else{
                        //display a modal
                        var modal =
                            '<div class="modal fade">\
                              <div class="modal-dialog">\
                         <div class="modal-content">\
                          <div class="modal-header">\
                            <h5 class="modal-title">Detalle de evento</h5>\
                            <button type="button" class="close" data-dismiss="modal">&times;</button>\
                          </div>\
                          <div class="modal-body">\
                            <form class="m-0">\
                              <div class="input-group">\
                                  <div class="input-groupp-repend align-self-center mr-2">\
                                    Nombre:\
                                  </div>\
                                  <input class="form-control" autocomplete="off" type="text" value="' + info.event.title + '" readonly/>\
                              </div>\
                            </form>\
                          </div>\
                              </div>\
                             </div>\
                            </div>';
                    }

                    var modal = $(modal).appendTo('body');
                    modal.find('form').on('submit', function(ev){
                        ev.preventDefault();

                        info.event.setProp('title' , $(this).find("input[type=text]").val());

                        modal.modal("hide");
                    });
                    modal.find('button[data-action=delete]').on('click', function() {
                        info.event.remove();
                        modal.modal("hide");
                    });

                    modal.modal('show').on('hidden.bs.modal', function(){
                        modal.remove();
                    });
                }
            });

            //
            calendar.render();
            @endif
        });

        // Tamaño maximo del archivo
        const maxSize = 5000000;

        // Obtener referencia al elemento
        const $miInput = document.querySelector("#documento");

        $miInput.addEventListener("change", function () {
            // si no hay archivos, regresamos
            if (this.files.length <= 0) return;

            // Validamos el primer archivo únicamente
            const archivo = this.files[0];
            if (archivo.size > maxSize) {
                // Limpiar
                $miInput.value = "";
                const tamanioEnMb = maxSize / 1000000;
                $(":submit").attr("disabled", true);
                mensaje_swal('warning', `El tamaño máximo es ${tamanioEnMb} MB`);
            }
            else{
                $(":submit").removeAttr("disabled");
            }
        });
    </script>
@endpush
