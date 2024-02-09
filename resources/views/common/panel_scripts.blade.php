
@include('common.global_scripts')
<!-- js de cada blade-->
@if(file_exists(public_path('js/scripts/panel/' .  app('primaryRoute')  . '.min.js')))
    <script src="{{ asset('js/scripts/panel/' .  app('primaryRoute') . '.min.js') }}?t={{ filemtime(public_path('js/scripts/panel/' .  app('primaryRoute'). '.min.js')) }}"></script>
@endif
@if(file_exists(public_path('js/scripts/panel/' .  app('primaryRoute').'_'.basename(request()->url()). '.min.js')))
    <script src="{{ asset('js/scripts/panel/' .   app('primaryRoute').'_'.basename(request()->url()). '.min.js') }}?t={{ filemtime(public_path('js/scripts/panel/' .   app('primaryRoute').'_'.basename(request()->url()). '.min.js')) }}"></script>
@endif
<!-- js de que se debe quitar de los blade-->
@stack('scripts')
