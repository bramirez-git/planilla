@extends('Layouts.menu')

@section('page-content')
    <form class="mt-lg-3" autocomplete="off" method="POST" action="{{route('colaboradoresConstanciaSalarial.store')}}">
        @csrf


        <div class="row pb-3">
            <div class="col-sm-8">
                <div class="form-group row mt-4">
                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre de documento') }}</label>
                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombreDocumento" name="nombreDocumento" readonly value="Constancia Salarial" required="true"/>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de Creación') }}</label>
                        <div class="input-group input-daterange">
                            <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaCreacion" name="fechaCreacion" required="true"/>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Usuario que registra') }}</label>
                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="usuarioRegistra" name="usuarioRegistra" readonly value="Jafet Sojo" required="true"/>
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Comentarios de la solicitud') }}</label>
                        <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" maxlength="200" placeholder="Límite de texto 200 caracteres" id="descripcionConstancia" name="descripcionConstancia" required="true" ></textarea>
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Constancia de salario') }}</label>
                        <div class="card bcard border-1 brc-dark-l1">
                            <div class="card-body p-0">
                                <textarea id="summernote" name="editordata">
                                    @include('componentes.constanciaSalarial')
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4" id='external-events'>
                <div class="bgc-white shadow-sm p-35 radius-1">
                    <p class="text-120 text-primary-d2">
                        Variables
                    </p>

                    <p id="alert-2" class="alert bgc-grey-l4 border-none border-l-4 brc-purple-m1">
                        Click para utilizar la variable.
                    </p>

                    <div>
                        {{ _('Día: ') }}<button type="button" class='variables_clic badge bgc-blue-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-blue-d1 text-white text-95">
                            ##Dia##
                        </button>
                        <br>

                        {{ _('Mes: ') }}<button type="button" class='variables_clic badge bgc-blue-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-blue-d1 text-white text-95">
                            ##Mes##
                        </button>
                        <br>

                        {{ _('Año: ') }}<button type="button" class='variables_clic badge bgc-blue-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-blue-d1 text-white text-95">
                            ##Anio##
                        </button>
                        <br>

                        {{ _('Nombre Colaborador: ') }}<button type="button" class='variables_clic badge bgc-red-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-red-d1 text-white text-95">
                            ##Nombre_Colaborador##
                        </button>
                        <br>

                        {{ _('Cédula: ') }}<button type="button" class='variables_clic badge bgc-red-d2 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-red-d2 text-white text-95">
                            ##Cedula##
                        </button>
                        <br>

                        {{ _('Día labora: ') }}<button type="button" class='variables_clic badge bgc-red-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-red-d1 text-white text-95">
                            ##Dia_Labora##
                        </button>
                        <br>

                        {{ _('Mes labora: ') }}<button type="button" class='variables_clic badge bgc-red-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-red-d1 text-white text-95">
                            ##Mes_Labora##
                        </button>
                        <br>

                        {{ _('Año labora: ') }}<button type="button" class='variables_clic badge bgc-red-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-red-d1 text-white text-95">
                            ##Anio_Labora##
                        </button>
                        <br>

                        {{ _('Puesto: ') }}<button type="button" class='variables_clic badge bgc-green-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-green-d1 text-white text-95">
                            ##Puesto##
                        </button>
                        <br>

                        {{ _('Salario Bruto: ') }}<button type="button" class='variables_clic badge bgc-green-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-green-d1 text-white text-95">
                            ##Salario_Bruto##
                        </button>
                        <br>

                        {{ _('Deducciones: ') }}<button type="button" class='variables_clic badge bgc-green-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-green-d1 text-white text-95">
                            ##Deducciones##
                        </button>
                        <br>

                        {{ _('Salario Neto: ') }}<button type="button" class='variables_clic badge bgc-green-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-green-d1 text-white text-95">
                            ##Salario_Neto##
                        </button>
                        <br>

                        {{ _('CCSS Enfermedad: ') }}<button type="button" class='variables_clic badge bgc-purple-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-purple-d1 text-white text-95">
                            ##CCSS_Enfermedad##
                        </button>
                        <br>

                        {{ _('CCSS Invalidez: ') }}<button type="button" class='variables_clic badge bgc-purple-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-purple-d1 text-white text-95">
                            ##CCSS_Invalidez##
                        </button>
                        <br>

                        {{ _('Banco Popular: ') }}<button type="button" class='variables_clic badge bgc-purple-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-purple-d1 text-white text-95">
                            ##Banco_Popular##
                        </button>
                        <br>

                        {{ _('Renta: ') }}<button type="button" class='variables_clic badge bgc-purple-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-purple-d1 text-white text-95">
                            ##Renta##
                        </button>
                        <br>

                        {{ _('Dia Solicitud: ') }}<button type="button" class='variables_clic badge bgc-orange-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-orange-d1 text-white text-95">
                            ##Dia_Solicitud##
                        </button>
                        <br>

                        {{ _('Mes Solicitud: ') }}<button type="button" class='variables_clic badge bgc-orange-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-orange-d1 text-white text-95">
                            ##Mes_Solicitud##
                        </button>
                        <br>

                        {{ _('Año Solicitud: ') }}<button type="button" class='variables_clic badge bgc-orange-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-orange-d1 text-white text-95">
                            ##Anio_Solicitud##
                        </button>
                        <br>

                    </div>
                </div>

            </div>
        </div>

        <!--vista previa-->
        <div class="modal fade " id="prevista" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-message modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title text-blue-d2">
                            Vista previa
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body ace-scrollbar bg-secondary">

                        <div class="modal-body ace-scrollbar">
                            <div class="card bcard mb-4">
                                <div class="card-body px-4 px-lg-5">
                                    <table style="width:100%;">
                                        <tr>
                                            <td>
                                                <div style="float: right; margin-top:20px;">
                                                    <img src='https://www.esencialcostarica.com/wp-content/uploads/2018/09/Logo-Cyberfuel.jpg' style='width:150px;'/>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="margin-top:50px;">
                                                    <h3 class="d-flex justify-content-center">
                                                        <input type="text" value="A quien interese" class="form-control brc-on-focus brc-blue-m1 col-sm-12 col-md-4" id="titulo" name="titulo">
                                                    </h3>
                                                    <p style="margin-top:35px;">
                                                        <b>14/03/2023</b>
                                                    </p>
                                                    <p style="margin-top:40px;">
                                                        Hago constar que <b>Juan Diego Morales Quesada</b>, portador de la c&eacute;dula No. <b>123456789</b>.
                                                        Labora para <b>Ministerio de Educación Pública (MEP)</b>. C&eacute;dula Jur&iacute;dica No. <b>987654321</b>,
                                                        desde el <b>01/01/2023</b> a la fecha, en el cargo de <b>Educador</b>,
                                                        algunas de sus funciones son: Funciones, entre otras, devengando un salario de:
                                                    </p>
                                                    <table style="width:100%">
                                                        <tr>
                                                            <td style="width:30%"><b>Salario base:</b></td>
                                                            <td style="width:70%">&cent; 1,000,000.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Deducciones:</b></td>
                                                            <td>&cent; 207,900.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Salario neto:</b></td>
                                                            <td>&cent; 792,100.00</td>
                                                        </tr>
                                                    </table>

                                                    <p>
                                                        La empresa no emite colillas de pago de planilla, el comprobante del salario se efect&uacute;a por medio
                                                        del correo que env&iacute;a la entidad bancaria con el dep&oacute;sito del salario neto correspondiente.
                                                    </p>

                                                    <p>Las deducciones corresponden a:</p>
                                                    <p><b>CCSS enfermedad y maternidad 5.50%</b> = &cent; 55,000.00</p>
                                                    <p><b>CCSS de Invalidez, Vejez y Muerte 3.84%</b> = &cent; 38,400.00</p>
                                                    <p><b>Banco Popular 1.00%</b> = &cent; 10,000.00</p>
                                                    <p><b>Renta</b> = &cent; 100,000.00</p>

                                                    <p>
                                                        <b>Embargo Expediente:</b> EXP987654321
                                                        <b style='margin-left:30px;'>Monto</b> = &cent; 4,500.00
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div style="margin-top:40px;">
                                                    <p>Se extiende la presente a solicitud del interesado en San José, el 14/03/2023.</p>
                                                    <p>Atentamente,</p>

                                                    <div style="text-align:center; margin-top:50px;">
                                                        <p>_______________________________________</p>
                                                        <p>Mar&iacute;a Jos&eacute; Espinoza</p>
                                                        <p>Departamento Recursos Humanos</p>
                                                    </div>

                                                    <p style="margin-top:80px;">
                                                        <em>
                                                            Para corroborar la veracidad de la Informaci&oacute;n emitida en est&aacute; constancia puede
                                                            contactarnos al tel&eacute;fono <input type="text" value="22049494" class="col-sm-12 col-md-2" id="telefonoContactar" name="telefonoContactar">
                                                            , usando el siguiente c&oacute;digo de
                                                            validaci&oacute;n: <input type="text" value="64038394" class="col-sm-12 col-md-2" id="codigoValidacion" name="codigoValidacion">

                                                        </em>
                                                    </p>

                                                    <p style="height:100px;"></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>


                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cerrar
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                <a href="{{ url()->previous() }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Cancelar
                </a>
                <a data-toggle="modal" data-target="#prevista" class="btn btn-outline-success btn-text-dark btn-h-success btn-a-success btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                            <span class="bgc-success h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                <i class="fa fa-eye mr-1 text-white text-120 mt-3px"></i>
                            </span>
                    Vista Previa
                </a>
                <button type="button" data-toggle="modal" data-target="#confirmModal" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Registrar
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
                        ¿Desea realizar una nueva solicitud de constancia salarial?
                        <br />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="Submit" class="btn btn-primary" >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
