@extends('Layouts.menu')

@section('page-content')
<div class="card h-100">
  <div class="card-header">
    <h5 class="card-title alert bgc-secondary-l3 text-dark-m1 border-none border-l-4 brc-blue radius-0 py-3 text-115"> <i class="fas fa-pen-to-square mr-2 mb-1 text-110 text-blue-d1 align-middle"></i> Puntos de Inspección </h5>
  </div>
  <div class="card-body">
    <div class="table-responsive border-t-3 brc-blue-m2">
      <table id="simple-table" class="resp mb-0 table  table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
        <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
          <tr>
            <th class="text-left text-secondary-d2 text-95 text-600"> Configuración </th>
            <th class="text-left text-secondary-d2 text-95 text-600"> Sección </th>
            <th class="d-none d-sm-table-cell text-left text-secondary-d2 text-95 text-600"> Completo </th

          </tr>
        </thead>
        <tbody class="mt-1">
          <tr class="bgc-h-blue-l4 d-style">
            <td data-label="Configuración:"><span class="text-95 text-primary-d2 p-1 text-capitalize"> <strong> Configuración Planilla </strong> </span></td>
            <td data-label="Sección:" class="text-grey-d1 text-right text-md-left"><a href="#">Ir a la sección <i class="fa fa-arrow-right ml-2 f-n-hover"></i></a></td>
            <td data-label="Completo:" class="text-grey-d1 text-right text-md-left"> No </td>
          </tr>

             <tr class="bgc-h-blue-l4 d-style">
            <td data-label="Configuración:"><span class="text-95 text-primary-d2 p-1 text-capitalize"> <strong>  Configuración de Bancos </strong> </span></td>
            <td data-label="Sección:" class="text-grey-d1 text-right text-md-left"><a href="#">Ir a la sección <i class="fa fa-arrow-right ml-2 f-n-hover"></i></a></td>
            <td data-label="Completo:" class="text-grey-d1 text-right text-md-left"> Si </td>
          </tr>

             <tr class="bgc-h-blue-l4 d-style">
            <td data-label="Configuración:"><span class="text-95 text-primary-d2 p-1 text-capitalize"> <strong> Configuración de departamentos</strong> </span></td>
            <td data-label="Sección:" class="text-grey-d1 text-right text-md-left"><a href="#">Ir a la sección <i class="fa fa-arrow-right ml-2 f-n-hover"></i></a></td>
            <td data-label="Completo:" class="text-grey-d1 text-right text-md-left"> No </td>
          </tr>

             <tr class="bgc-h-blue-l4 d-style">
            <td data-label="Configuración:"><span class="text-95 text-primary-d2 p-1 text-capitalize"> <strong> Configuración de Ocupaciones</strong> </span></td>
            <td data-label="Sección:" class="text-grey-d1 text-right text-md-left"><a href="#">Ir a la sección <i class="fa fa-arrow-right ml-2 f-n-hover"></i></a></td>
            <td data-label="Completo:" class="text-grey-d1 text-right text-md-left"> Si </td>
          </tr>

             <tr class="bgc-h-blue-l4 d-style">
            <td data-label="Configuración:"><span class="text-95 text-primary-d2 p-1 text-capitalize"> <strong> Configuración  de Empleados </strong> </span></td>
            <td data-label="Sección:" class="text-grey-d1 text-right text-md-left"><a href="#">Ir a la sección <i class="fa fa-arrow-right ml-2 f-n-hover"></i></a></td>
            <td data-label="Completo:" class="text-grey-d1 text-right text-md-left"> No </td>
          </tr>

             <tr class="bgc-h-blue-l4 d-style">
            <td data-label="Configuración:"><span class="text-95 text-primary-d2 p-1 text-capitalize"> <strong>Configuración  X </strong> </span></td>
            <td data-label="Sección:" class="text-grey-d1 text-right text-md-left"><a href="#">Ir a la sección <i class="fa fa-arrow-right ml-2 f-n-hover"></i></a></td>
            <td data-label="Completo:" class="text-grey-d1 text-right text-md-left"> Si </td>
          </tr>

             <tr class="bgc-h-blue-l4 d-style">
            <td data-label="Configuración:"><span class="text-95 text-primary-d2 p-1 text-capitalize"> <strong>Configuración Y </strong> </span></td>
            <td data-label="Sección:" class="text-grey-d1 text-right text-md-left"><a href="#">Ir a la sección <i class="fa fa-arrow-right ml-2 f-n-hover"></i></a></td>
            <td data-label="Completo:" class="text-grey-d1 text-right text-md-left"> No </td>
          </tr>

             <tr class="bgc-h-blue-l4 d-style">
            <td data-label="Configuración:"><span class="text-95 text-primary-d2 p-1 text-capitalize"> <strong>Configuración Z </strong> </span></td>
            <td data-label="Sección:" class="text-grey-d1 text-right text-md-left"><a href="#">Ir a la sección <i class="fa fa-arrow-right ml-2 f-n-hover"></i></a></td>
            <td data-label="Completo:" class="text-grey-d1 text-right text-md-left"> No </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push("scripts")



@endpush
