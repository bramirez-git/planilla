@extends('Layouts.menu')

@section('page-content')

    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-start mb-sm-0 pb-4">
            <a href="{{ route('solicitudes.edit',['1']) }}" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px ">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-plus mr-1 text-white text-120 mt-3px" aria-hidden="true"></i>
						</span>
                Realizar solicitud
            </a>
        </div>
    </div>
<div class="page-content container container-plus">
    <div class="row mb-425">
        <div class="col-lg-6 col-sm-12 cards-container" id="card-container-1">
            <div class="card dcard" id="card-1">
                <div class="card-header">
                    <h5 class="card-title">
                        {{ __('Resumen de solicitudes') }}
                    </h5>
                </div><!-- /.card-header -->

                <div class="card-body p-0">


                        <div class="form-group row">
                            <div class="col-12 radius-1 table-responsive">
                                 <table id="simple-table" class="mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-left text-secondary-d2 text-95 text-600">Tipo</th>
                                        <th class="text-left text-secondary-d2 text-95 text-600">Usado</th>
                                        <th class="text-left text-secondary-d2 text-95 text-600">Disponible</th>
                                        <th class="text-left text-secondary-d2 text-95 text-600">Aprobado</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-nowrap">
                                            <i class="fa fa-circle text-orange-d2 mr-1px"></i>
                                            Vacaciones
                                        </td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">2</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">16</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">18</td>
                                    </tr>
                                    <tr>  <td class="text-nowrap">
                                            <i class="fa fa-circle text-info-d2 mr-1px"></i>
                                            Incapacidad
                                        </td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">0</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">28</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">28</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <i class="fa fa-circle text-blue-d2 mr-1px"></i>
                                            Teletrabajo
                                        </td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">4</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">26</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">30</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <i class="fa fa-circle text-green-d2 mr-1px"></i>
                                            Entreno
                                        </td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">0</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">1</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">1</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <i class="fa fa-circle text-purple-d2 mr-1px"></i>
                                            Permiso especial
                                        </td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">0</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">5</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600">1</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                </div><!-- /.card-body -->
            </div>
        </div>
         <div class="col-lg-6 col-sm-12 cards-container" id="card-container-1">
            <div class="card bcard" id="card-1">
                <div class="card-header">
                    <h5 class="card-title">
                        {{ __('Personas en día libre hoy') }}
                    </h5>
                </div><!-- /.card-header -->

                <div class="card-body p-0">


                        <div class="form-group row">
                            <div class="col-sm-12 radius-1 table-responsive">
                               <table id="simple-table" class="mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                                    <tr>
                                        <th>Colaborador</th>
                                        <th class="text-left text-secondary-d2 text-95 text-600">4</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Juan Perez Rosales</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600"></td>
                                    </tr>
                                    <tr>
                                        <td>Pedro Bonilla Fallas</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600"></td>
                                    </tr>
                                    <tr>
                                        <td>Maria Gonzalez Soto</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600"></td>
                                    </tr>
                                    <tr>
                                        <td>Rosa Garcia Vasquez</td>
                                        <td class="text-left text-secondary-d2 text-95 text-600"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                </div><!-- /.card-body -->
            </div>
        </div>
    </div>

    <div class="row mb-425">
        <div class="col-12">

                    <div class="row mt-1">
                        <div class="col-md-6 col-12 mt-2 mt-md-0">
                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha Inicial') }}</label>
                            <div class="input-group input-daterange">
                                <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaInicialVacaciones" name="fechaInicialVacaciones" required="true"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mt-2 mt-md-0">
                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha Final') }}</label>
                            <div class="input-group input-daterange">
                                <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaFinalVacaciones" name="fechaFinalVacaciones" required="true"/>
                            </div>
                        </div>

                    </div>
         <div class="row mt-1 justify-content-between">
 <div class="col-md-4 col-sm-12 mt-2 mt-md-0">
                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Colaborador') }}</label>

                            <div class="tag-input-style" id="select2-parent">
                                <select multiple id="tag-colaborador" class="select2 form-control" >
                                    <option value='1'>Juan</option>
                                    <option value='2'>Maria</option>
                                    <option value='3'>Andrea</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mt-2 mt-md-0">
                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Departamento') }}</label>

                            <div class="tag-input-style" id="select2-parent">
                                <select multiple id="tag-departamento" class="select2 form-control" >
                                    <option value='1'>Recursos humanos</option>
                                    <option value='2'>Contabilidad</option>
                                    <option value='3'>Informática</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mt-2 mt-md-0">
                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de solicitud') }}</label>
                            <div class="tag-input-style" id="select2-parent">
                                <select multiple id="tag-solicitud" class="select2 form-control" >
                                    <option value='1'>Vacaciones</option>
                                    <option value='2'>Incapacidad</option>
                                    <option value='3'>Permiso Especial</option>
                                </select>
                            </div>
                        </div>

            </div>
        </div>


    </div>

    <div class="row mt-3" style="max-width: 1040px !important;">
              <div class="col-12">
                <div class="card dcard">
                  <div class="card-body px-1 px-md-3">


                  <div class="table-responsive">
                        <table class="table table-bordered" >
                            <thead>
                            <tr>
                                @php
                                $dias = 30;
                                @endphp
                                <th class="first-column-table">Colaborador</th>
                                @for($contador = 1;$contador <= $dias; $contador++)
                                    <th>{{ $contador }}</th>
                                @endfor
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td class="text-nowrap first-column-table" >Maria Rojas Mena</td>
                                @php
                                    $dias = 30;
                                @endphp

                                @for($contador = 1;$contador <= $dias; $contador++)
                                    <!-- Deberia de mostrarse en gris, sabados, domingos y feriados, cambiarlo a que se valide con el calendario-->
                                    @switch($contador)
                                        @case(6) <th class="bgc-grey-l2"> </th> @break
                                        @case(7) <th class="bgc-grey-l2"> </th> @break
                                        @case(13) <th class="bgc-grey-l2"> </th> @break
                                        @case(14) <th class="bgc-grey-l2"> </th> @break
                                        @case(20) <th class="bgc-grey-l2"> </th> @break
                                        @case(21) <th class="bgc-grey-l2"> </th> @break
                                        @case(27) <th class="bgc-grey-l2"> </th> @break
                                        @case(28) <th class="bgc-grey-l2"> </th> @break
                                        @case(in_array($contador,range(10,12)))
                                            <th>
                                                <i class="fa fa-circle text-orange-d2 mr-1px"></i>
                                            </th>
                                            @break
                                        @default
                                            <th></th>
                                    @endswitch
                                @endfor
                            </tr>
                            <tr>
                                <td class="text-nowrap first-column-table" >Juan Perez Rosales</td>
                                @php
                                    $dias = 30;
                                @endphp

                                @for($contador = 1;$contador <= $dias; $contador++)
                                    <!-- Deberia de mostrarse en gris, sabados, domingos y feriados, cambiarlo a que se valide con el calendario-->
                                    @switch($contador)
                                        @case(6) <th class="bgc-grey-l2"> </th> @break
                                        @case(7) <th class="bgc-grey-l2"> </th> @break
                                        @case(13) <th class="bgc-grey-l2"> </th> @break
                                        @case(14) <th class="bgc-grey-l2"> </th> @break
                                        @case(20) <th class="bgc-grey-l2"> </th> @break
                                        @case(21) <th class="bgc-grey-l2"> </th> @break
                                        @case(27) <th class="bgc-grey-l2"> </th> @break
                                        @case(28) <th class="bgc-grey-l2"> </th> @break
                                        @case(in_array($contador,range(15,20)))
                                            <th>
                                                <i class="fa fa-circle text-purple-d2 mr-1px"></i>
                                            </th>
                                            @break
                                        @default
                                            <th></th>
                                    @endswitch
                                @endfor
                            </tr>
                            <tr>
                                <td class="text-nowrap first-column-table" >Pedro Vargas Diaz</td>
                                @php
                                    $dias = 30;
                                @endphp

                                @for($contador = 1;$contador <= $dias; $contador++)
                                    <!-- Deberia de mostrarse en gris, sabados, domingos y feriados, cambiarlo a que se valide con el calendario-->
                                    @switch($contador)
                                        @case(6) <th class="bgc-grey-l2"> </th> @break
                                        @case(7) <th class="bgc-grey-l2"> </th> @break
                                        @case(13) <th class="bgc-grey-l2"> </th> @break
                                        @case(14) <th class="bgc-grey-l2"> </th> @break
                                        @case(20) <th class="bgc-grey-l2"> </th> @break
                                        @case(21) <th class="bgc-grey-l2"> </th> @break
                                        @case(27) <th class="bgc-grey-l2"> </th> @break
                                        @case(28) <th class="bgc-grey-l2"> </th> @break
                                        @case(in_array($contador,range(29,30)))
                                            <th>
                                                <i class="fa fa-circle text-orange-d2 mr-1px"></i>
                                            </th>
                                            @break
                                        @default
                                            <th></th>
                                    @endswitch
                                @endfor
                            </tr>
                            </tbody>
                        </table>
                    </div>


                  </div><!-- /.card-body -->
                </div><!-- /.card -->
              </div><!-- /.col -->
            </div>
</div>
@endsection
