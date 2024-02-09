@extends('Layouts.blankLayout')

@section('page-content')
    <div class="card h-100" style="position: relative; display: inline-block; vertical-align: middle; margin: 0 auto; text-align: left; width: 30%; z-index: 1045;">
        <div class="card-header">
            <span class="card-title text-125 font-bold">
                {{ $info["nombre_colaborador"] }}
            </span>
        </div>
        <div class="card-body">
            Se han encontrado los siguientes errores:<br><br>
           {!! $info["mensajes"] !!}
        </div>
        <div class="card-footer">
            <div class="text-right">
                <button type="button" class="btn btn-secondary" onclick="closeMagnificPopup();">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <script>
        function closeMagnificPopup() {
            $('.mfp-close').trigger('click');
        }
    </script>
@endsection
