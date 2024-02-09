@extends('Layouts.menu')

@section('page-content')

    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            <form method="GET" action="{{ route('colaboradoresConstanciaSalarial.create') }}">
                @csrf
                <input type="text" name="id_colaborador" value="{{Crypt::encrypt($idColaborador)}}" hidden>
                <button type="submit" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                            </span>
                    Agregar Constancia Salarial
                </button>
            </form>
        </div>

        <div class="text-nowrap align-self-start pl-md-2">
            <div class="d-inline-flex align-items-center ml-sm-0  mr-1 pb-4">
{{--                <a href="#" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">--}}
{{--                        <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">--}}
{{--							<i class="fa fa-file-excel mr-1 text-white text-120 mt-3px"></i>--}}
{{--						</span>--}}
{{--                    Exportar excel--}}
{{--                </a>--}}
            </div>

            <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
                <i class="fa fa-search text-grey-m1 pos-abs ml-2"></i>
                <input type="text" class="form-control pl-425 h-5" placeholder="Buscar">
            </div>
        </div>
    </div>

    <div class="table-responsive">

        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                 <th scope="col" class="text-left text-md-center align-middle">
                    Usuario de RRHH que la registró
                </th>

                <th scope="col" class="text-left text-md-center align-middle">
                    Fecha de creación
                </th>

                 <th scope="col" class="text-left text-md-center align-middle">
                    Acción
                </th>
            </tr>
            </thead>

            <tbody class="mt-1">
            <tr class="bgc-h-blue-l4 d-style">
                <td data-label="Usuario de RRHH que la registró:" class='text-grey-d1 text-right text-md-center small'>
                    Mary Codish
                </td>

                 <td data-label="Fecha de creación:" class='text-grey-d1 text-right text-md-center small'>
                    14/10/2022
                </td>

                <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>

                    <form method="POST" action="{{ route('colaboradoresConstanciaSalarial.update',[Crypt::encrypt('1')]) }}">
                        @csrf
                        @method('PUT')
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex float-right'>
                            <a href="{{ route('colaboradoresConstanciaSalarial.show',[Crypt::encrypt('1')]) }}" title="Mostrar Constancia" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="#" data-toggle="modal" data-target="#dangerModal{{'1'}}" title="Duplicar Constancia" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-info btn-a-lighter-info">
                                <i class="fa fa-clone"></i>
                            </a>
                        </div>

                        <!-- show a dropdown in mobile -->
                        <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                            <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>

                            <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                <div class="dropdown-inner">
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        {{ __('Acción') }}
                                    </div>
                                    <a href="{{ route('colaboradoresConstanciaSalarial.show',['1']) }}" class="dropdown-item">
                                        <i class="fa fa-eye text-success mr-1 p-2 w-4"></i>
                                        {{ __('Mostrar Constancia') }}
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#dangerModal{{'1'}}" class="dropdown-item">
                                        <i class="fa fa-clone text-info-m1 mr-1 p-2 w-4"></i>
                                        {{ __('Duplicar Constancia') }}
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="modal fade" data-backdrop-bg="bgc-white" id="dangerModal{{'1'}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                                    <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                        <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel">
                                            ¡Atención!
                                        </h5>

                                        <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="text-150">&times;</span>
                                        </button>
                                    </div>


                                    <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                        <div class="d-flex align-items-top mr-2 mr-md-5">
                                            <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                            <div class="text-secondary-d2 text-105">
                                                ¿Desea duplicar la constancia salarial?
                                            </div>
                                        </div>

                                        <div class="form-group row mt-4">
                                            <div class="col-sm-12">
                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Nueva fecha de vigencia</label>
                                                <div class="input-group">
                                                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaVigencia" name="fechaVigencia" required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer bgc-white-tp2 border-0">
                                        <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                            No
                                        </button>

                                        <button type="submit" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                            Si
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- table footer -->
    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-center align-self-sm-start  pt-3">
            <span class="d-inline-block text-grey-d2">
                Mostrando 1 - 10 de 152
						</span>

            <select class="ml-3 ace-select no-border angle-down brc-h-blue-m3 w-auto pr-45 text-secondary-d3">
                <option value="10">Mostrar 10</option>
                <option value="20">Mostrar 20</option>
                <option value="50">Mostrar 50</option>
            </select>
        </div>

        <div class="btn-group align-self-center align-self-sm-start pt-3">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-arrow-left"></i></a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-arrow-right"></i></a></li>
            </ul>
        </div>
    </div>
@endsection
