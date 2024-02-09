<form class="mt-lg-3" id="frm-colaboradores-vacaciones" autocomplete="off" method="POST" action="{{route('colaboradoresEditarVacaciones')}}">
    @csrf
    @method('POST')
    <input type="text" name="tipoForm" value="vacaciones" hidden/>
    <input type="text" name="tab" value="vacaciones-tab" hidden/>
    <input type="hidden" name="id_colaborador" value="{{$idColaborador}}"/>
    <div class="table-responsive border-t-3 brc-blue-m2">
        <table id="simple-table" class="resp mb-0 table  table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th scope="col" class="text-center font-weight-bold" style="padding-right:80px;"> Rango de años</th>
                <th scope="col" class="text-center font-weight-bold"> Factor</th>
                <th scope="col" class="text-center font-weight-bold"> Descripción</th>
            </tr>
            </thead>
            <tbody class="mt-1">
            <tr class="bgc-h-blue-l4 d-style text-center">
                <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                    <div class="col-sm-12 offset-1">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input id="rango-uno-from" name="vacaciones[factor1][rango-from]" type="text" class="input-group form-control brc-on-focus brc-blue-m1 number-input text-center" value="{{$resultadoVacaciones[0]->rango_from??""}}">
                            </div>
                            <div class="text-grey-d1">_</div>
                            <div class="col-md-4">
                                <input id="rango-uno-to" name="vacaciones[factor1][rango-to]" type="text" class="input-group form-control brc-blue-m1 brc-on-focus number-input text-center" value="{{$resultadoVacaciones[0]->rango_to??""}}">
                            </div>
                        </div>
                    </div>
                </td>
                <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                    <input type="number" class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12 col-md-8 text-center offset-2" id="factor1" name="vacaciones[factor1][factor]" value="{{$resultadoVacaciones[0]->factor??""}}"/>
                </td>
                <td data-label="Descripción:" class='text-right text-md-center small text-dark'> Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 0.833) = 10 días.</td>
            </tr>
            <tr class="bgc-h-blue-l4 d-style">
                <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                    <div class="col-sm-12 offset-1">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input id="rango-dos-from" name="vacaciones[factor2][rango-from]" type="text" class="input-group form-control brc-on-focus brc-blue-m1 number-input text-center" value="{{$resultadoVacaciones[1]->rango_from??""}}">
                            </div>
                            <div class="text-grey-l2">_</div>
                            <div class="col-md-4">
                                <input id="rango-dos-to" name="vacaciones[factor2][rango-to]" type="text" class="input-group form-control brc-on-focus brc-blue-m1 number-input text-center" value="{{$resultadoVacaciones[1]->rango_to??""}}">
                            </div>
                        </div>
                    </div>
                </td>
                <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                    <input type="number" class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12 col-md-8 text-center offset-2" id="factor2" name="vacaciones[factor2][factor]" value="{{$resultadoVacaciones[1]->factor??""}}"/>
                </td>
                <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'> Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 1) = 12 días.</td>
            </tr>
            <tr class="bgc-h-blue-l4 d-style">
                <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                    <div class="col-sm-12 offset-1">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input id="rango-tres-from" name="vacaciones[factor3][rango-from]" type="text" class="input-group form-control brc-on-focus brc-blue-m1 number-input text-center" value="{{$resultadoVacaciones[2]->rango_from??""}}">
                            </div>
                            <div class="text-grey-l2">_</div>
                            <div class="col-md-4">
                                <input id="rango-tres-to" name="vacaciones[factor3][rango-to]" type="text" class="input-group form-control brc-on-focus brc-blue-m1 number-input text-center" value="{{$resultadoVacaciones[2]->rango_to??""}}">
                            </div>
                        </div>
                    </div>
                </td>
                <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                    <input type="number" class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12 col-md-8 text-center offset-2" id="factor3" name="vacaciones[factor3][factor]" value="{{$resultadoVacaciones[2]->factor??""}}"/>
                </td>
                <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'> Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 1.2) = 15 días.</td>
            </tr>
            <tr class="bgc-h-blue-l4 d-style">
                <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                    <div class="col-sm-12 offset-1">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input id="rango-cuatro-from" name="vacaciones[factor4][rango-from]" type="text" class="input-group form-control brc-on-focus brc-blue-m1 number-input text-center" value="{{$resultadoVacaciones[3]->rango_from??""}}">
                            </div>
                            <div class="text-grey-l2">_</div>
                            <div class="col-md-4">
                                <input id="rango-cuatro-to" name="vacaciones[factor4][rango-to]" type="text" class="input-group form-control brc-on-focus brc-blue-m1 number-input text-center" value="{{$resultadoVacaciones[3]->rango_to??""}}">
                            </div>
                        </div>
                    </div>
                </td>
                <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                    <input type="number" class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12 col-md-8 text-center offset-2" id="factor4" name="vacaciones[factor4][factor]" value="{{$resultadoVacaciones[3]->factor??""}}"/>
                </td>
                <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'> Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 2) = 24 días.</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
        <div class="md-3 col-md-9 col-sm-12 text-nowrap">
            <a href="{{ url()->previous() }}" class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i> </span> Cancelar
            </a>
            <button type="button" id="registrarVcaciones" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i> </span> Guardar
            </button>
        </div>
    </div>
</form>
@if(file_exists(public_path('js/scripts/admin/config_colaborador_vacaciones.min.js')))
    <script src="{{ asset('js/scripts/admin/config_colaborador_vacaciones.min.js') }}?t={{ filemtime(public_path('js/scripts/admin/config_colaborador_vacaciones.min.js')) }}"></script>
@endif
