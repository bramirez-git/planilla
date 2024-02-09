
    <div class="table-responsive border-t-3 brc-blue-m2" >
        @if(empty($resultado['descripcion']))
        <div class="table-responsive" style="">
            <table class="resp mb-0 table table-striped table-borderless table-bordered-x text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2 ">
                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4 sticky-top">    
                    <tr>
                        <th>#</th>
                        <!-- <th>Descripción</th> -->
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody class="mt-1">
                    @foreach($resultado['fechas'] as $key => $datos)
                        <tr>
                            <td>{{ ($key + 1) }}</td>
                            <!-- <td>{{ $resultado['datos']}}</td> -->
                            <td>{{ $datos }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="container mt-4">
            <div class="row">
                <div class="col">
                <h5>{{ $resultado['datos'] }}</h5>
                <hr>
                </div>
            </div>
            @foreach($resultado['fechas'] as $key => $datos)
                <div class="row">
                    <div class="col ">
                        <p>{{ $resultado['descripcion'][$key]}}</p>
                    </div>
            
                    <div class="col ">
                        <p>{{ $datos }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
