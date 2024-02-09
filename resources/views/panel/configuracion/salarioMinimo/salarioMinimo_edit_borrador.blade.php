@extends('Layouts.menuPanel')

@section('page-content')

    <form class="mt-lg-3" autocomplete="off" method="POST" action="{{route('configuracionSalarioMinimo.update',['123'])}}">
        @csrf
        @method('PUT')
        <div class="form-group row mt-4">

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Salario mínimo actual </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">₡</span>
                    </div>
                    <input type="text" min="0" lang="en" step="0.5" value="216.887,24" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="salarioMinimo" name="salarioMinimo" required="true">
                </div>
            </div>

            <div class="col-md-3 col-sm-12 align-self-end">
                <button type="button" data-toggle="modal" data-target="#confirmModalBanco"  class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                    <i class="fa fa-pen-to-square mr-1 text-white text-120 mt-3px"></i>
                                </span>
                    Actualizar
                </button>
            </div>

        </div>
        <div class="modal fade" id="confirmModalBanco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel">
                            Mensaje
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        ¿Desea actualizar el salario mínimo?
                        <br />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary" >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="row mb-475">
        <div class="col-12">
            <div class="table-responsive">
                <table id="simple-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
                    <thead class="text-dark-tp3 bgc-grey-l4 text-90 border-b-1 brc-transparent">
                    <tr>
                        <th class="text-center font-bold">
                            Salario neto(Sin cargas sociales e impuestos)
                        </th>
                        <th class="text-center" >
                            Salario neto sin el salario mínimo inembargable
                        </th>
                        <th class="text-center" >
                            Primera barrera
                        </th>
                        <th class="text-center" >
                            Segunda barrera
                        </th>
                        <th class="text-center" >
                            Total embargable
                        </th>
                    </tr>
                    </thead>

                    <tbody class="mt-1">
                    <tr class="bgc-h-blue-l4 d-style">
                        <td class="text-grey-d1 font-bold text-center">
                            ₡ 216 887
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 0
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 0
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 0
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 0
                        </td>
                    </tr>

                    <tr class="bgc-h-blue-l4 d-style">
                        <td class="text-grey-d1 font-bold text-center">
                            ₡ 400 000
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 183 113
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 22 889
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 0
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 22 889
                        </td>
                    </tr>

                    <tr class="bgc-h-blue-l4 d-style">
                        <td class="text-grey-d1 font-bold text-center">
                            ₡ 600 000
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 383 113
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 47 889
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 0
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 47 889
                        </td>
                    </tr>

                    <tr class="bgc-h-blue-l4 d-style">
                        <td class="text-grey-d1 font-bold text-center">
                            ₡ 800 000
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 583 113
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 72 889
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 0
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 72 889
                        </td>
                    </tr>

                    <tr class="bgc-h-blue-l4 d-style">
                        <td class="text-grey-d1 font-bold text-center">
                            ₡ 1 000 000
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 783 113
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 81 333
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 33 113
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 114 445
                        </td>
                    </tr>

                    <tr class="bgc-h-blue-l4 d-style">
                        <td class="text-grey-d1 font-bold text-center">
                            ₡ 1 500 000
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 1 283 113
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 81 333
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 158 113
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 239 445
                        </td>
                    </tr>

                    <tr class="bgc-h-blue-l4 d-style">
                        <td class="text-grey-d1 font-bold text-center">
                            ₡ 2 500 000
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 2 283 113
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 81 333
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 408 113
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 489 445
                        </td>
                    </tr>

                    <tr class="bgc-h-blue-l4 d-style">
                        <td class="text-grey-d1 font-bold text-center">
                            ₡ 4 000 000
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 3 783 113
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 81 333
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 783 113
                        </td>

                        <td class='text-grey-d1 text-center'>
                            ₡ 864 445
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
