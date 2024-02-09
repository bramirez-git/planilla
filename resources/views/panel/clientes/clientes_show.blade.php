@extends('Layouts.menuPanel')

@section('page-content')
    <form class="mt-lg-3" autocomplete="off" method="POST" action="{{route('clientes.update',[Crypt::encrypt($resultado->id_empresa)])}}">
        @csrf
        @method('PUT')

        <div class="form-group row mt-4">
            <input type="hidden" id="estado" name="estado" value="{{ $resultado->estado=="activo"?"inactivo":"activo" }}"/>
            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre del cliente') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombreCliente" name="nombreCliente" value="{{ old('nombreCliente') ?? $resultado->nombre }}" readonly/>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Identificación') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="identificacionCliente" name="identificacionCliente" value="{{ old('identificacionCliente') ?? $resultado->identificacion }}" readonly/>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Correo') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correoCliente" name="correoCliente" value="{{ old('correoCliente') ?? $resultado->correo }}" readonly/>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Teléfono') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="telefonoCliente" name="telefonoCliente" value="{{ old('telefonoCliente') ?? $resultado->telefono_fijo }}" readonly/>
            </div>

        </div>


        <div class="form-group row mt-4">

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Cantidad de colobaradores') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="cantidadColaboradores" name="cantidadColaboradores" value="{{ old('cantidadColaboradores') ?? $resultado->total_colaboradores }}" readonly/>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Saldo Actual') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="saldoActual" name="saldoActual" value="${{ old('saldoActual') ?? $resultado->monto_saldo }}" readonly/>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Estado') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="estadoCliente" name="estadoCliente" value="{{ old('estadoCliente') ?? $resultado->estado }}" readonly/>
            </div>

        </div>

        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                <button type="button" data-toggle="modal" data-target="#confirmModal" class="btn btn-outline-info btn-text-dark btn-h-info btn-a-info btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-info h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-file-circle-exclamation mr-1 text-white text-120 mt-3px"></i>
						</span>
                    @if($resultado->estado==="activo")
                        Desactivar
                    @else
                        Activar
                    @endif
                </button>
            </div>
        </div>

        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        @if($resultado->estado==="activo")
                            ¿Desea desactivar el cliente?
                        @else
                            ¿Desea activar el cliente?
                        @endif
                        <br />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary btn-modal-cargando">
                            @if($resultado->estado==="activo")
                                Desactivar
                            @else
                                Activar
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
