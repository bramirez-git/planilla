
<!-- js necesarios del templete -->
<script src="{{ asset('estilos/node_modules/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('estilos/node_modules/jquery/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('estilos/node_modules/dist/umd/popper.js') }}"></script>
<script src="{{ asset('estilos/node_modules/bootstrap/dist/js/bootstrap.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- include vendor scripts used in "Dashboard 3" page. see "application/views/default/pages/partials/dashboard-3/@vendor-scripts.hbs') }}" -->
@if(session()->has('graficos'))
    <script src="{{ asset('estilos/node_modules/chart.js/dist/Chart.js') }}"></script>
    <!--<script src="{{ asset('estilos/node_modules/sortablejs/Sortable.js') }}"></script> -->
@endif

<script src="{{ asset('estilos/node_modules/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('estilos/node_modules/bootbox/bootbox.all.js') }}"></script>
<script src="{{ asset('estilos/node_modules/cropper/js/jquery.Jcrop.js') }}"></script>
<script src="{{ asset('estilos/node_modules/cropper/js/jquery.SimpleCropper.js') }}"></script>
<script src="{{ asset('estilos/node_modules/basictable/jquery.basictable.js') }}"></script>
<script src="{{ asset('estilos/node_modules/select2/dist/js/select2.js') }}"></script>
<script src="{{ asset('estilos/node_modules/chosen-js/chosen.jquery.js') }}"></script>
<script src="{{ asset('estilos/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('estilos/node_modules/jqtree/tree.jquery.js') }}"></script>
<script src="{{ asset('estilos/node_modules/typeahead.js/dist/typeahead.bundle.js') }}"></script>

@if(session()->has('fullCalendar'))
    <script src="{{ asset('estilos/node_modules/fullcalendar/main.js') }}"></script>
    <script src="{{ asset('estilos/node_modules/fullcalendar/locales-all.js') }}"></script>
@endif

<script src="{{ asset('estilos/node_modules/photoswipe/dist/photoswipe.js') }}"></script>
<script src="{{ asset('estilos/node_modules/photoswipe/dist/photoswipe-ui-default.js') }}"></script>
<script src="{{ asset('estilos/node_modules/datepicker/js/bootstrap-datepicker.js') }}"></script>

@if(session()->has('payCards'))
    <script src="{{ asset('estilos/node_modules/PayCards/js/card.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('estilos/node_modules/PayCards/js/main.js') }}"></script>
@endif

<script src="{{ asset('estilos/node_modules/dropzone/dist/dropzone.js') }}"></script>

<script src="{{ asset('estilos/application/views/default/pages/partials/dashboard-3/@page-script.js') }}"></script>

<script src="{{ asset('estilos/application/views/default/pages/partials/tables-basic/@page-script.js') }}"></script>
<script src="{{ asset('estilos/application/views/default/pages/partials/gallery/@page-script.js') }}"></script>

@if(session()->has('fullCalendar'))
    <script src="{{ asset('estilos/application/views/default/pages/partials/calendar/@page-script.js') }}"></script>
@endif

<script src="{{ asset('estilos/application/views/default/pages/partials/form-upload/@page-script.js') }}"></script>

@if(session()->has('dropZone'))
    <script src="{{ asset('estilos/application/views/default/pages/partials/form-basic/@page-script.js') }}"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
@endif

<script src="{{ asset('estilos/application/views/default/pages/partials/form-more/@page-script.js') }}"></script>
<script src="{{ asset('estilos/application/views/default/pages/partials/treeview/@page-script.js') }}"></script>
<script src="{{ asset('estilos/application/views/default/pages/partials/form-basic/@page-script.js') }}"></script>
<!-- js necesarios del templete end -->

@if(session()->has('graficos'))
    <script src="{{ asset('estilos/graficas/Highcharts-11.0.0/code/highcharts.js') }}"></script>
    <script src="{{ asset('estilos/graficas/Highcharts-11.0.0/code/highcharts-3d.js') }}"></script>
    <script src="{{ asset('estilos/graficas/Highcharts-11.0.0/code/modules/exporting.js') }}"></script>
    <script src="{{ asset('estilos/graficas/Highcharts-11.0.0/code/modules/export-data.js') }}"></script>
    <script src="{{ asset('estilos/graficas/Highcharts-11.0.0/code/modules/accessibility.js') }}"></script>
@endif

<script src="{{ asset('js/noUiSlider-15.7.1/nouislider.min.js') }}"></script>

<script src="{{ asset('js/suggestInput/jquery.amsify.suggestags.js') }}"></script>

<script type='text/javascript'>
    var base_path = '{{ url('/') }}';
    var rutaImagenCargando = "{{ asset('img/339_loader.gif') }}";
    var config_tiempo_sesion = "{{ empty(session()->get('tiempo_sesion'))?50:session()->get('tiempo_sesion')}}";
    var reCAPTCHA_site_key_cliente = "{{env('reCAPTCHA_site_key_cliente')}}";

</script>

<!-- js lib necesarios -->
<script src="{{ asset('js/underscore-1.9.1/underscore.min.js') }}"></script>
<script src="{{ asset('js/jscolor-2.0.5/jscolor.min.js') }}"></script>
<script src="{{ asset('js/intlTelInput-12.1.0/intlTelInput.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2-11.7.32/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/jquery-inputmask-3.3.11/mask.js') }}"></script>
<script src="{{ asset('js/magnific-popup-1.1.0/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/jszip-utils-0.0.2/jszip-utils.min.js') }}"></script>
<script src="{{ asset('js/jszip-v3.10.1-1/jszip.min.js') }}"></script>
@if(session()->has('plupload'))
    <script src="{{ asset('js/plupload-3.1.5/plupload.full.min.js') }}"></script>
@endif
<script src="{{ asset('js/super_event.min.js') }}?t={{ filemtime(public_path('js/super_event.min.js')) }}"></script>
<script src="{{ asset('js/jquery.serializeObject.min.js') }}?t={{ filemtime(public_path('js/jquery.serializeObject.min.js')) }}"></script>
<script src="{{ asset('js/LocalWatcher.min.js') }}?t={{ filemtime(public_path('js/LocalWatcher.min.js')) }}"></script>
@if(session()->has('wysiwyg'))
    <script type="text/javascript" src="{{ asset('js/5/ckeditor.js') }}"></script>
@endif

<!-- js lib necesarios end -->

<!-- js globales necesarios -->
<script src="{{ asset('js/ace.min.js') }}"></script>
<script src="{{ asset('js/demo.min.js') }}"></script>
<script src="{{ asset('js/herramientasPlanillaProfesional.min.js') }}?t={{ filemtime(public_path('js/herramientasPlanillaProfesional.min.js')) }}"></script>
<script src="{{ asset('js/cargando.min.js') }}?t={{ filemtime(public_path('js/cargando.min.js')) }}"></script>
<script src="{{ asset('js/global.min.js') }}?t={{ filemtime(public_path('js/global.min.js')) }}"></script>
<script src="{{ asset('js/global_ui.min.js') }}?t={{ filemtime(public_path('js/global_ui.min.js')) }}"></script>
<script src="{{ asset('js/traduccionMensajes.min.js') }}?t={{ filemtime(public_path('js/traduccionMensajes.min.js')) }}"></script>
<script src="{{ asset('js/scripts/admin/admin.min.js') }}?t={{ filemtime(public_path('js/scripts/admin/admin.min.js')) }}"></script>
<!-- js globales necesarios -->

{{-- mensajes de éxito e error --}}
@if(session()->has('success'))
    <script type='text/javascript'>mostrarAlertaExito('{{ session()->get('success')}}'); </script>
@endif

@if(session()->has('ui_alert') && is_array(session()->get('ui_alert')))
    <script type='text/javascript'> ui_alert('{{session()->get('ui_alert')['tipo']}}','{{ session()->get('ui_alert')['mensaje'] }}'); </script>
@endif

@if(session()->has('errors'))
    @php
        $contador = 1;
        $mensaje1 = "";
        $mensaje2 = "";
    @endphp
    @foreach($errors->all() as $error)
        @if($contador==1)
            @php
                $mensaje1 = $error
            @endphp
        @endif
        @if($contador==2)
            @php
                $mensaje2 = $error
            @endphp
        @endif

        @php
            $contador++
        @endphp
    @endforeach
    <script type='text/javascript'> mostrarAlertaError('{{ $mensaje1 }}','{{ $mensaje2 }}'); </script>
@endif
{{-- mensajes de éxito e error end --}}
