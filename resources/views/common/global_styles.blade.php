<!-- css necesarios del templete -->
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/bootstrap/dist/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/@fortawesome/fontawesome-free/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/@fortawesome/fontawesome-free/css/fontawesome.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/@fortawesome/fontawesome-free/css/regular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/@fortawesome/fontawesome-free/css/brands.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/@fortawesome/fontawesome-free/css/solid.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/@fortawesome/fontawesome-free/css/svg-with-js.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/@fortawesome/fontawesome-free/css/v4-font-face.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/@fortawesome/fontawesome-free/css/v4-shims.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/@fortawesome/fontawesome-free/css/v5-font-face.css') }}">

@if(session()->has('fullCalendar'))
    <link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/fullcalendar/main.css') }}">
@endif

<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/bootstrap-select/dist/css/bootstrap-select.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/chosen-js/chosen.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/datepicker/css/estilosPicker.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/datepicker/css/bootstrapdatepicker.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/select2/dist/css/select2.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/cropper/css/style-crop.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/cropper/css/style-example.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/cropper/css/jquery.Jcrop.css') }}"/>

<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/photoswipe/dist/photoswipe.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/photoswipe/dist/default-skin/default-skin.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/basictable/basictable.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/jqtree/jqtree.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/PayCards/css/card.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/PayCards/css/estilos.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/estilosPlanilla.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('estilos/node_modules/dropzone/dist/dropzone.css') }}">

<!-- include fonts -->
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/dist/css/ace-font.css') }}">

<!-- ace.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/dist/css/ace.css') }}">

<!-- favicon -->
<link rel="icon" type="image/png" href="{{ asset('estilos/assets/favicon.png') }}" />


<!-- "Dashboard 3" page styles, specific to this page for demo only -->
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/application/views/default/pages/partials/dashboard-3/@page-style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/application/views/default/pages/partials/tables-basic/@page-style.css') }}">
@if(session()->has('graficos'))
    <link rel="stylesheet" type="text/css" href="{{ asset('estilos/application/views/default/pages/partials/dashboard/@page-style.css') }}">
@endif

<link rel="stylesheet" type="text/css" href="{{ asset('estilos/dist/css/ace-themes.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('estilos/graficas/estilos/graficas.css') }}">

<!-- Magnific -->
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/application/css/src/magnific.css') }}">

<!--  picker de mes y año-->
<link rel="stylesheet" type="text/css" href="{{ asset('estilos/application/css/src/jquery-mes.css') }}">

<!-- css globales nesesarios -->
<!-- Telefonos  -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<!-- Telefonos  -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/intlTelInput.css')}}">
<!-- cargando.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2-11.7.32/sweetalert2.css') }}">
<!-- suggestinput.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/suggestInput/amsify.suggestags.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('js/noUiSlider-15.7.1/nouislider.min.css') }}">



