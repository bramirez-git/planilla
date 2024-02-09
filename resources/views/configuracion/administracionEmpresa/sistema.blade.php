<form id="form-sistema" class="mt-lg-3" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="Configuración del sistema" hidden/>
    <input type="text" name="tab" value="sistema-tab" hidden/>
    <br>
    <h3 class="card-title text-125 text-green-m2">
        <i class="nav-icon fa fa-user-clock text-green-m2"></i>
        {{ __('Configuración del tiempo de sesión') }}
    </h3>
    <hr>
    <br>
    <div class="form-group row mt-4 mb-15">
        <div class="col-md-4 col-sm-12 mb-2">
            <label for="intervalo-tiempo" class="mb-0 text-blue-m1 text-125 mb-5">
                <span class="tooltip-info" data-rel="tooltip" data-placement="top" title="" data-original-title="Por seguridad, cerramos tu sesión automáticamente según la configuración establecida en esta sección"> <i class="fa-solid fa-circle-question blue"></i> </span>
                {{ __('Tiempo de sesión') }}
            </label>
            <div id="slider" class="mt-4"></div>
        </div>
    </div>
    <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
        <div class="md-3 col-md-9 col-sm-12 text-nowrap">
            <a href="{{ url()->previous() }}" class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                Cancelar
            </a>
            <button id="registrarConfigSistema" type="button" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                Guardar
            </button>
        </div>
    </div>
</form>
 <!--validaciones-->
<script>
    $(document).ready(function() {
        $('[data-rel=tooltip]').tooltip({html: true});

        var valuesSlider = document.getElementById('slider');
        var valuesForSlider = [];
        for (let i = 5; i <= 50; i += 5) {
            valuesForSlider.push(i);
        }
        var format = {
            to: function(value) {
                return valuesForSlider[Math.round(value)];
            },
            from: function (value) {
                return valuesForSlider.indexOf(Number(value));
            }
        };

        var valueStart ={{empty(session()->get('tiempo_sesion'))?50:session()->get('tiempo_sesion')}};

        var sliderSesion = noUiSlider.create(valuesSlider, {
            start: [valueStart],
            connect:[true,false],
            // A linear range from 0 to 15 (16 values)
            range: { min: 0, max: valuesForSlider.length - 1 },
            // steps of 1
            step: 1,
            tooltips: {
                to: function(value) {
                    return format.to(value) + ' min';  // Agregar "minutos" solo al tooltip
                }
            },
            format: format,
            pips: { mode: 'steps', format: format },
        });


        $("#registrarConfigSistema").on('click', function (evt)
        {
            confirmar('Configuración', '¿Desea actualizar la configuración  del sistema?', 'question', function(){
                waitingDialog.show();
                // Evitar el envío predeterminado del formulario
                event.preventDefault();

                // Obtener los valores actuales del control deslizante
                var sliderValues = sliderSesion.get();

                // Agregar los valores al formulario como un campo oculto
                $("<input />").attr("type", "hidden")
                .attr("name", "tiempo_sesion")
                .attr("value", JSON.stringify(sliderValues))
                .appendTo("#form-sistema");

                // Enviar el formulario
                $("#form-sistema").submit();
            });
        });
    });
</script>


