@extends('Layouts.menu')

@section('page-content')

    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            <a href="{{ route('colaboradoresEmbargos.create') }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
						</span>
                Agregar Embargo
            </a>
        </div>

        <div class="text-nowrap align-self-start pl-md-2">
            <button type="button" data-toggle="modal" data-target="#calcularEmbargos" class="btn btn-outline-danger btn-text-dark btn-h-danger btn-a-danger btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                <span class="bgc-danger h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                    <i class="fa fa-calculator mr-1 text-white text-120 mt-3px"></i>
                </span>
                {{ __('Calculadora embargos') }}
            </button>
            <div class="d-inline-flex align-items-center ml-sm-0  mr-1 pb-4">
                <a href="#" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                        <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-file-word mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Exportar a txt
                </a>
            </div>
        </div>
    </div>

    @include('componentes.calculadoraEmbargos')

    <div class="table-responsive">

        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
               <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Nombre Colaborador
                </th>

                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Número Expediente
                </th>

                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Tipo Embargo
                </th>

              <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Beneficiario
                </th>

               <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Moneda
                </th>

               <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Monto de Embargo
                </th>

               <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Fecha
                </th>

                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Acción
                </th>
            </tr>
            </thead>

            <tbody class="mt-1">
            <tr class="bgc-h-blue-l4 d-style">

                <td data-label=" Nombre Colaborador:" class='text-grey-d1 text-right text-md-center small'>
                    Mary Codish
                </td>

               <td data-label=" Número Expediente:" class='text-grey-d1 text-right text-md-center small'>
                    135-000000
                </td>

                 <td data-label=" Tipo Embargo:" class='text-grey-d1 text-right text-md-center small'>
                    Pensión
                </td>

                <td data-label="Beneficiario:" class='text-grey-d1 text-right text-md-center small'>
                    Rosa Salazar Vargas
                </td>

                <td data-label="Moneda:" class='text-grey-d1 text-right text-md-center small'>
                    Colones
                </td>

                <td data-label="Monto de Embargo:" class='text-grey-d1 text-right text-md-center'>
                   <span class="badge badge-primary badge-md mb-2"> ₡200,000  </span>
                </td>

                 <td data-label="Fecha:" class='text-grey-d1 text-right text-md-center small'>
                    30/11/2022
                </td>

               <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                    <!-- action buttons -->
                    <div class='d-none d-lg-flex justify-content-center'>
                        <a href="{{ route('colaboradoresEmbargos.show',[Crypt::encrypt('1')]) }}" title="Mostrar detalle préstamo" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                            <i class="fa fa-eye"></i>
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
                                <a href="{{ route('colaboradoresEmbargos.show',[Crypt::encrypt('1')]) }}" class="dropdown-item">
                                    <i class="fa fa-eye text-success mr-1 p-2 w-4"></i>
                                    {{ __('Mostrar detalle préstamo') }}
                                </a>

                            </div>
                        </div>
                    </div>
                </td>
            </tr>
           <tr class="bgc-h-blue-l4 d-style">

                <td data-label=" Nombre Colaborador:" class='text-grey-d1 text-right text-md-center small'>
                    Mary Codish
                </td>

               <td data-label=" Número Expediente:" class='text-grey-d1 text-right text-md-center small'>
                    135-000000
                </td>

                 <td data-label=" Tipo Embargo:" class='text-grey-d1 text-right text-md-center small'>
                    Pensión
                </td>

                <td data-label="Beneficiario:" class='text-grey-d1 text-right text-md-center small'>
                    Rosa Salazar Vargas
                </td>

                <td data-label="Moneda:" class='text-grey-d1 text-right text-md-center small'>
                    Dolares
                </td>

                <td data-label="Monto de Embargo:" class='text-grey-d1 text-right text-md-center'>
                   <span class="badge badge-primary badge-md mb-2"> ₡200,000  </span>
                </td>

                 <td data-label="Fecha:" class='text-grey-d1 text-right text-md-center small'>
                    30/11/2022
                </td>

               <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                    <!-- action buttons -->
                    <div class='d-none d-lg-flex justify-content-center'>
                        <a href="{{ route('colaboradoresEmbargos.show',[Crypt::encrypt('1')]) }}" title="Mostrar detalle préstamo" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                            <i class="fa fa-eye"></i>
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
                                <a href="{{ route('colaboradoresEmbargos.show',[Crypt::encrypt('1')]) }}" class="dropdown-item">
                                    <i class="fa fa-eye text-success mr-1 p-2 w-4"></i>
                                    {{ __('Mostrar detalle préstamo') }}
                                </a>

                            </div>
                        </div>
                    </div>
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
