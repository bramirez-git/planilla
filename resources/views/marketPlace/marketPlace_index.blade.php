@extends('Layouts.menu')

@section('page-content')
    <div class="row">
        @foreach($resultado as $data)
        <div class="col-12 col-sm-6 col-lg-4 mt-3 mt-sm-0 cards-container mb-4" id="card-container-8">
            <div class="card dcard overflow-hidden" id="card-9" draggable="true">
                <div class="card-header">
                    <h5 class="card-title text-110 text-primary-d2 pt-1"> {{$data->nombre}} </h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body bg-white p-0 collapse show">
                    <div class="p-3">
                        <p class="text-justify"> {{$data->descripcion}} </p>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-6 ml-auto">
                            <div class="pos-rel text-right pr-4">
                                <span class="text-dark-tp4 text-140 mr-n2px">$</span>
                                <span class="text-dark-tp3 text-180">{{$data->precio}}</span>
                                <span class="text-blue-m1 text-600 text-90 ml-15 text-nowrap"><i class="fa fa-plus"></i> IVA / mes</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bgc-white px-4 py-3 brc-dark-l3 d-flex justify-content-end">
                    @if($data->contratado==="no")
                        <button onclick="ui_contratar_servicio('{{ $data->id_servicio }}')" type="button" class="btn btn-primary btn-raised py-2 px-25 text-105 mb-1">
                            Contratar
                            <i class="fa fa-arrow-right ml-2"></i>
                        </button>
                    @elseif($data->contratado==="si")
                        <button onclick="ui_servicio_config('{{ $data->id_servicio }}')" class="d-inline-block radius-round bgc-success-d1 py-2 px-1 text-center border-3 brc-white-tp1 shadow-sm ml-2">
                            <i class="fa fa-gears w-4 text-105 text-white-tp1"></i>
                        </button>
                    @endif
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        @endforeach
    </div>
@endsection
