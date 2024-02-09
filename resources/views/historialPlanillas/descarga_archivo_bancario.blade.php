@extends('Layouts.blankLayout')

@section('page-content')
    <div class="card h-100" style="position: relative; display: inline-block; vertical-align: middle; margin: 0 auto; text-align: left; width: 30%; z-index: 1045;">
        <div class="card-header">
            <span class="card-title text-125 font-bold">
                Archivo Bancario
            </span>
        </div>
        <div class="card-body">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-grey font-bold mt-2 mb-2">Banco de la empresa:</div>
                        <div class="d-flex flex-wrap align-items-center">
                            @foreach($bancos as $info_banco)
                                @if(in_array($info_banco->codigo, array("BAC", "BCR", "DAVI", "PROM", "SCOT")))
                                    @if($infoPlanilla->id_banco == $info_banco->id_banco)
                                        @php
                                            switch($info_banco->codigo){
                                                case  "BAC": $img_banco = "bac.png"; break;
                                                case  "BCR": $img_banco = "bcr.png"; break;
                                                case "DAVI": $img_banco = "davivienda.png"; break;
                                                case "PROM": $img_banco = "promerica.png"; break;
                                                case "SCOT": $img_banco = "scotiabank.png"; break;
                                            }
                                        @endphp

                                        <a onclick="descargar_txt_banco('{{ $info_banco->id_banco }}');" class="p-2" style="cursor:pointer;">
                                            <img src="{{ url('/img/imagenesBancos/' . $img_banco) }}" width="150" height="100" class="p-2 border dh-zoom-1">
                                        </a>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-grey font-bold mt-2 mb-2">Otros bancos:</div>
                        <div class="d-flex flex-wrap align-items-center">
                            @foreach($bancos as $info_banco)
                                @if(in_array($info_banco->codigo, array("BAC", "BCR", "DAVI", "PROM", "SCOT")))
                                    @if($infoPlanilla->id_banco != $info_banco->id_banco)
                                        @php
                                            switch($info_banco->codigo){
                                                case  "BAC": $img_banco = "bac.png"; break;
                                                case  "BCR": $img_banco = "bcr.png"; break;
                                                case "DAVI": $img_banco = "davivienda.png"; break;
                                                case "PROM": $img_banco = "promerica.png"; break;
                                                case "SCOT": $img_banco = "scotiabank.png"; break;
                                            }
                                        @endphp

                                        <a onclick="descargar_txt_banco('{{ $info_banco->id_banco }}');" class="p-2" style="cursor:pointer;">
                                            <img src="{{ url('/img/imagenesBancos/' . $img_banco) }}" width="150" height="100" class="p-2 border dh-zoom-1">
                                        </a>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

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
