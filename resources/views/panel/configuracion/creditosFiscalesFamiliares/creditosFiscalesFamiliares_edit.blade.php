@extends('Layouts.menuPanel')

@section('page-content')
    <form class="mt-lg-3" id="frm_cerdito_familiar" autocomplete="off" method="POST" action="{{route('configuracionCreditoFamiliar.update',[Crypt::encrypt($resultado->id_credito_familiar)])}}">
        @csrf
        @method('PUT')
        <div class="row mb-475">
            <div class="col-12">
                <div class="table-responsive border-t-3 brc-blue-m2">
                    <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                        <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
                        <tr>
                            <th class="text-center" colspan="3">
                                Créditos familiares
                            </th>
                        </tr>
                        <tr>

                            <th class="text-center text-white">
                                Relación
                            </th>

                            <th class="text-center text-white">
                                Monto Mensual
                            </th>

                            <th class='text-center text-white'>
                                Monto Anual
                            </th>
                        </tr>
                        </thead>

                        <tbody class="mt-1">

                        <tr class="bgc-h-blue-l4 d-style">

                            <td class='text-center'>
                                Cónyugue
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₡</span>
                                    </div>
                                    <input type="text" value="{{number_format($resultado->monto_mensual_conyuge,2)}}" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-6 number-input text-right" id="montoMensualConyugue" name="montoMensualConyugue"/>
                                </div>
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₡</span>
                                    </div>
                                    <input type="text" value="{{number_format($resultado->monto_anual_conyuge,2)}}" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-6 number-input text-right" id="montoAnualConyugue" name="montoAnualConyugue"/>
                                </div>
                            </td>
                        </tr>
                        <tr class="bgc-h-blue-l4 d-style">

                            <td class='text-center'>
                                Hijo
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₡</span>
                                    </div>
                                    <input type="text" value="{{number_format($resultado->monto_mensual_hijo,2)}}" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-6 number-input text-right" id="montoMensualHijo" name="montoMensualHijo"/>
                                </div>
                            </td>

                            <td class='text-grey-d1'>
                                <div class="input-group justify-content-center">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₡</span>
                                    </div>
                                    <input type="text" value="{{number_format($resultado->monto_anual_hijo,2)}}" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-6 number-input text-right" id="montoAnualHijo" name="montoAnualHijo"/>
                                </div>
                            </td>

                        </tr>

                        </tbody>
                    </table>
                </div>

                <br>
                <div class="alert alert-secondary bgc-secondary-l4 brc-secondary-l2 text-dark-tp2" role="alert">
                    <h5 class="alert-heading text-primary-d1 font-bolder">
                        Créditos familiares
                    </h5>

                    <div class="card-body bgc-white border-1 border-t-0 brc-success-m3">
                        <div class="jqtree tree-dotted" id="id-jqtree-files"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                <a href="{{ url('panelAdministracion/configuracion')  }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                    <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                        <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
                    </span>
                    Cancelar
                </a>
                <button type="button" id="btn_guardar" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                        <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                    </span>
                    Guardar
                </button>
            </div>
        </div>
    </form>
    @include('componentes.modalCargando')
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function(){

            $("#btn_guardar").on('click', function (evt)
            {
                if($('#frm_cerdito_familiar').valid())
                {
                    $('#cargando').modal('show');
                    $('#frm_cerdito_familiar').submit();
                }
                else{
                    return false;
                }
            });

            $('#frm_cerdito_familiar').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: generateRules(),
                messages: generateMessages(),
                errorPlacement: function (error, element) {
                    if (element.hasClass("form-control")) {
                        error.insertAfter(element.closest('.input-group'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $('.limited-to-100').on('input', function() {
                // Obtenemos el valor ingresado y lo convertimos a un número
                var valor = parseFloat($(this).val());

                // Verificamos si el valor es mayor a 100
                if (valor > 100) {
                    // Si es mayor a 100, ajustamos el valor a 100
                    $(this).val(100);
                }
            });
            function generateRules() {
                var rules = {};
                $('#frm_cerdito_familiar .input-group input').each(function() {
                    var name=$(this).attr('name');
                    rules[name] = {
                        required: true
                    };
                });
                return rules;
            }

            function generateMessages() {
                var messages = {};
                $('#frm_cerdito_familiar .input-group input').each(function() {
                    var name=$(this).attr('name');
                    messages[name] = {
                        required: "Este campo es requerido."
                    };
                });
                return messages;
            }
        });

    </script>
@endpush
