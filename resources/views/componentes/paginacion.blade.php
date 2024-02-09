<form method="GET" @isset($paginacionEditar) action="{{ Request::url() }}/edit" @else action="{{ Request::url() }}" @endisset id="paginacionForm">
    <input type="text" name="buscar" value="{{ $buscar ?? '' }}" hidden />
    <input type="text" name="columna" value="{{ $columna ?? '' }}" hidden />
    @isset($idColaborador)
    <input type="text" name="id_colaborador" value="{{ Crypt::encrypt($idColaborador) ?? '' }}" hidden />
    @endisset

    @csrf
    <!-- table footer -->
    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-center align-self-sm-start  pt-3">
                <span class="d-inline-block text-grey-d2">
                    @if($total_paginas == $paginaActual)
                        Mostrando {{($paginaActual*$cantidad)-$cantidad+1}} - {{$total}} de {{$total}}
                    @else
                        Mostrando {{($paginaActual*$cantidad)-$cantidad+1}} - {{$paginaActual*$cantidad}} de {{$total}}
                    @endif
                </span>

            <select name="cantidad" onchange="this.form.submit()" class="ml-3 ace-select no-border angle-down brc-h-blue-m3 w-auto pr-45 text-secondary-d3">
                <option value="25" @if($cantidad==25) selected @endif>Mostrar 25</option>
                <option value="100" @if($cantidad==100) selected @endif>Mostrar 100</option>
                <option value="300" @if($cantidad==300) selected @endif>Mostrar 300</option>
            </select>
        </div>

        <div class="btn-group align-self-center align-self-sm-start pt-3">
            <ul class="pagination">
                <!--<li class="page-item"><button type="button" class="page-link" name="paginaInicial"><i class="fa fa-angles-left"></i></button></li>-->
                @if($total_paginas<=5)
                    @for($paginas = 1; $paginas <= $total_paginas; $paginas++)
                        <li class="page-item"><input type="submit" class="page-link @if($paginas == $paginaActual) btn-blue @endif" name="pagina" value="{{$paginas}}" /></li>
                    @endfor
                @else
                    @if($paginaActual<=3)
                        @for($paginas = 1; $paginas <= 5; $paginas++)
                            <li class="page-item"><input type="submit" class="page-link @if($paginas == $paginaActual) btn-blue @endif" name="pagina" value="{{$paginas}}" /></li>
                        @endfor
                        <li class="page-item"><input type="button" class="page-link" name="pagina" value="..." /></li>
                        <li class="page-item"><input type="submit" class="page-link" name="pagina" value="{{$total_paginas}}" /></li>
                    @else
                        @if($paginaActual>$total_paginas-3)
                            <li class="page-item"><input type="submit" class="page-link" name="pagina" value="1" /></li>
                            <li class="page-item"><input type="button" class="page-link" name="pagina" value="..." /></li>
                            @for($paginas = $total_paginas-4; $paginas <= $total_paginas; $paginas++)
                                <li class="page-item"><input type="submit" class="page-link @if($paginas == $paginaActual) btn-blue @endif" name="pagina" value="{{$paginas}}" /></li>
                            @endfor
                        @else
                            <li class="page-item"><input type="submit" class="page-link" name="pagina" value="1" /></li>
                            <li class="page-item"><input type="button" class="page-link" name="pagina" value="..." /></li>
                            @for($paginas = $paginaActual-2; $paginas <= $paginaActual+2; $paginas++)
                                <li class="page-item"><input type="submit" class="page-link @if($paginas == $paginaActual) btn-blue @endif" name="pagina" value="{{$paginas}}" /></li>
                            @endfor
                            <li class="page-item"><input type="button" class="page-link" name="pagina" value="..." /></li>
                            <li class="page-item"><input type="submit" class="page-link" name="pagina" value="{{$total_paginas}}" /></li>
                        @endif
                    @endif
                @endif
                <!--<li class="page-item"><button type="submit" class="page-link" name="paginaFinal"><i class="fa fa-angles-right"></i></button></li>-->
            </ul>
        </div>
    </div>
</form>

