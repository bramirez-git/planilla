<div class="container">
    <div class="html_servicio_adicional">
        <h3 class="card-title text-150 text-green-m2 text-center">
            {{$resultado->nombre}}
        </h3>
        <hr>
        <div class="space-10"></div><div class="row">
            <div class="col-xs-12 col-md-12">
                <h4 class="card-title text-125 text-green-m2">
                    Descripción
                </h4>
                <hr>
                <p class="text-90">
                    {{$resultado->descripcion}}
                </p>
                <h4 class="card-title text-125 text-green-m2">
                    Precio
                </h4>
                <hr>
                <p class="text-90">${{$resultado->precio}} USD + IVA / mensuales</p>
                <hr>
                <button class="btn btn-primary btn-raised py-2 px-25 text-95 mb-1" type="button" onclick="$(this).hide();$('#start_MOD_gastos').show('fast');"><i class="fa fa-file-signature"></i>&nbsp;Activar servicio.</button>
            </div>
            <div class="col-xs-12 col-md-12">
                <div id="start_MOD_gastos" style="display: none;">
                    <div class="card border-0 shadow-sm radius-0">
                        <div class="card-header bgc-primary-d1">
                            <div class="text-left card-title text-white">
                                Términos y condiciones de uso:
                            </div>
                        </div>
                        <div id="div_deposito" class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0" style="">
                            <div class="panel-body text-85" style="height: 150px; overflow: auto;">
                                <style>
                                    ol {
                                        counter-reset: item; list-style-type: none;
                                    }
                                    ol > li:before {
                                        content: counters(item, ".") ". ";
                                        counter-increment: item;
                                    }
                                    ul {
                                        list-style-type: disc;
                                    }
                                </style>
                                <p class="ml-2 mt-2">Todos los servicios adicionales de <a href="https://www.planillaprofesional.com/" target="_blank">planillaprofesional.com</a> están sujetos en primera instancia a los términos y condiciones de este, además de los que se presentan a continuación:</p>
                                <div class="space-4"></div>
                                <ol class="ml-4">
                                    <li class="mt-2">Al contratar por primera vez un servicio adicional el sistema procederá con la renovación automática utilizando su saldo disponible.</li>
                                    <li class="mt-2">En caso de dar de baja un servicio adicional o por algún otro motivo requerir un respaldo, deberá realizarlo por cuenta propia mientras el contrato de este se encuentre vigente.</li>
                                    <li class="mt-2">Los pagos de servicios adicionales no son bajo ningún caso reembolsables o transferibles a otro servicio adicional o a su membresía.</li>
                                </ol>
                            </div>
                            <div class="card-footer bgc-grey-l4">
                                <form id="frm_contratar_serv" method="PUT" action="{{ route('marketPlace.edit',$resultado->id_servicio) }}">
                                    @csrf
                                    @method('PUT')
                                        <div class="clearfix">
                                            <div class="form-group row">
                                                <div class="col-xs-12">
                                                    <div class="input-group mb-2">
                                                        <label class="input-group">
                                                            <input type="checkbox" name="acepta_condiciones" value="1" id="acepta_condiciones" class="ace">
                                                            <span class="lbl text-85">&nbsp;He leído y acepto los términos y condiciones de uso</span>
                                                        </label>
                                                    </div>
                                                    <button class="btn btn-primary btn-raised py-2 px-25 text-95 mb-1" onclick="contratar_servicio()">Activar servicio&nbsp;<i class="fa fa-arrow-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
<script>
    $('#frm_contratar_serv').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            acepta_condiciones: {
                required: true
            },

        },
        messages: {
            acepta_condiciones: {
                required: "Este campo es requerido."
            }
        },
        errorPlacement: function(error, element){
            if(element.hasClass("form-control")){
                error.insertAfter(element.closest('.input-group'));
            }else{
                error.insertAfter(element);
            }
        }
    });

</script>
