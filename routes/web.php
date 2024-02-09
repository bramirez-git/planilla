<?php

use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//establece como principal el inicio de sesion
Route::get('/', 'Autenticacion\UsuariosController@showLoginForm')->name("inicio");
Route::post('verificarSesion','Autenticacion\UsuariosController@verificarSesion')->name('verificarSesion');

Route::group(['middleware' => ['authNormal']], function() {

    //colaboradores
    Route::resource('colaboradores', 'ColaboradoresController')->except(['show']);

    //Colaboradores Tool bar
    Route::resource('colaboradoresConfiguracion', 'ColaboradoresConfiguracionController')->only(['edit', 'update']);
    Route::get('colaboradoresEliminarContacto/{idColaborador}/{idContacto}', 'ColaboradoresConfiguracionController@eliminarContactoEmergencia')->name("colaboradoresEliminarContacto");
    Route::get('colaboradoresEditarConyugue/', 'ColaboradoresConfiguracionController@editarConyugue')->name("colaboradoresEditarConyugue");
    Route::get('colaboradoresEliminarFamiliar/{idColaborador}/{idFamiliar}', 'ColaboradoresConfiguracionController@eliminarFamiliar')->name("colaboradoresEliminarFamiliar");
    Route::get('colaboradoresEliminarVehiculo/{idColaborador}/{idVehiculo}', 'ColaboradoresConfiguracionController@eliminarVehiculo')->name("colaboradoresEliminarVehiculo");
    Route::get('colaboradoresEliminarPermisoConducir/{idColaborador}/{idPermisoConducir}', 'ColaboradoresConfiguracionController@eliminarPermisoConducir')->name("colaboradoresEliminarPermisoConducir");
    Route::get('colaboradoresEliminarBanco/{idColaborador}/{idBanco}', 'ColaboradoresConfiguracionController@eliminarBanco')->name("colaboradoresEliminarBanco");
    Route::get('revisarConfiguracionColaborador/{idPlanilla}/{idColaborador}', 'ColaboradoresConfiguracionController@revisarConfiguracionColaborador')->name('revisarConfiguracionColaborador');
    Route::resource('colaboradoresPerfil', 'ColaboradoresPerfilController')->only(['edit', 'update']);
    Route::resource('colaboradoresConstanciaSalarial', 'ColaboradoresConstanciaSalarialController')->except(['edit']);
    Route::resource('colaboradoresEmbargos', 'ColaboradoresEmbargosController')->except(['edit', 'update']);
    Route::resource('colaboradorAccionPersonal', 'ColaboradoresAccionPersonalController')->except(['edit', 'update']);
    Route::get('/colaboradorConstancia/pdf', 'ColaboradoresConstanciaSalarialController@createPDF');
    Route::resource('colaboradoresCurriculum', 'ColaboradoresCurriculumController');
    Route::resource('colaboradoresAmonestaciones', 'ColaboradoresAmonestacionesController');
    Route::resource('colaboradoresDocumentosDigitales', 'ColaboradoresDocumentosDigitalesController')->only(['index','show']);
    Route::get('uiDocumentoDigitales/{idColaborador}', 'ColaboradoresDocumentosDigitalesController@ui_documento_digitales')->name('uiDocumentoDigitales');
    Route::get('uiEnviarCorreo/{idColaborador}', 'ColaboradoresDocumentosDigitalesController@uiEnviarCorreo')->name('uiEnviarCorreo');
    Route::post('descargar_doc_digitales', 'ColaboradoresDocumentosDigitalesController@descargar_doc_digitales')->name('descargar_doc_digitales');
    Route::post('colaboradoresEditarHistorico', 'ColaboradoresConfiguracionController@editarHistorico')->name("colaboradoresEditarHistorico");
    Route::post('colaboradoresEditarHistoricoVacaciones', 'ColaboradoresConfiguracionController@editarHistoricoVacaciones')->name("colaboradoresEditarHistoricoVacaciones");
    Route::post('colaboradoresEditarVacaciones', 'ColaboradoresConfiguracionController@editarVacaciones')->name("colaboradoresEditarVacaciones");
    Route::get('uiDocumentoColaboradores', 'ColaboradoresController@ui_documento_colaboradores')->name('uiDocumentoColaboradores');
    Route::post('descarga_excel_colaborador_accion_personal', 'ColaboradoresAccionPersonalController@descargar_excel')->name('descarga_excel_colaborador_accion_personal');
    Route::get('consulta_dias', 'ColaboradoresAccionPersonalController@consulta_dias')->name('consulta_dias');
    
    //colaboradores configuracion
    Route::get('colaboradores_configuracion_index/{id_colaborador}', 'ColaboradoresConfiguracionController@colaboradores_configuracion')->name('colaboradores_configuracion_index');
    Route::get('tab_CCSSINS/{id_colaborador}', 'ColaboradoresConfiguracionController@tab_CCSSINS')->name('tab_CCSSINS');
    Route::get('tab_contactoEmergencia/{id_colaborador}', 'ColaboradoresConfiguracionController@tab_contactoEmergencia')->name('tab_contactoEmergencia');
    Route::get('tab_familiares/{id_colaborador}', 'ColaboradoresConfiguracionController@tab_familiares')->name('tab_familiares');
    Route::get('tab_vehiculos/{id_colaborador}', 'ColaboradoresConfiguracionController@tab_vehiculos')->name('tab_vehiculos');
    Route::get('tab_permisoConducir/{id_colaborador}', 'ColaboradoresConfiguracionController@tab_permisoConducir')->name('tab_permisoConducir');
    Route::get('tab_planilla_colaborador/{id_colaborador}', 'ColaboradoresConfiguracionController@tab_planilla')->name('tab_planilla_colaborador');
    Route::get('tab_bancos_colaborador/{id_colaborador}', 'ColaboradoresConfiguracionController@tab_bancos')->name('tab_bancos_colaborador');
    Route::get('tab_vacaciones/{id_colaborador}', 'ColaboradoresConfiguracionController@tab_vacaciones')->name('tab_vacaciones');
    Route::get('tab_historico/{id_colaborador}', 'ColaboradoresConfiguracionController@tab_historico')->name('tab_historico');

    //Colaboradores prestamos
    Route::resource('colaboradoresPrestamos', 'ColaboradoresPrestamosController')->except(['edit', 'update']);
    Route::post('calcularCuotaMensualPrestamo/','ColaboradoresPrestamosController@calcularCuotaMensualPrestamo')->name('calcularCuotaMensualPrestamo');
    Route::get('verDetallePrestamo/{idColaborador}/{idPrestamo}','ColaboradoresPrestamosController@show')->name('verDetallePrestamo');
    Route::post('aplicarAbonoExtraPrestamo','ColaboradoresPrestamosController@aplicarAbonoExtraPrestamo')->name('aplicarAbonoExtraPrestamo');
    Route::post('descargarExcelPrestamos/','ColaboradoresPrestamosController@descargarExcelPrestamos')->name('descargarExcelPrestamos');
    Route::post('descargarPdfPrestamo/','ColaboradoresPrestamosController@descargarPdfPrestamo')->name('descargarPdfPrestamo');
    Route::post('descargarExcelTablaAmortizacionProyectada/','ColaboradoresPrestamosController@descargarExcelTablaAmortizacionProyectada')->name('descargarExcelTablaAmortizacionProyectada');

    //formularios de acciones de personal
    Route::post('/formularioAccionPersonal','FormularioAccionPersonal@mostrarformulario')->name('formularioAccionPersonal');
    Route::post('/subirArchivoAccionPersonal/{idColaborador}/{id_accion}/{categoria}','FormularioAccionPersonal@subirArchivoAccionPersonal')->name('subirArchivoAccionPersonal');

    //RH: Departamentos
    Route::resource('departamentos', 'DepartamentosController')->except(['show']);
    Route::get('link_config_departamentos', 'DepartamentosController@index')->name("link_config_departamentos");
    Route::post('/descargar_excel_departamentos', 'DepartamentosController@descargar_excel')->name('descargar_excel_departamentos');

    //RH: Calendario
    Route::resource('calendario', 'CalendarioController')->only(['index']);
    Route::post('fullCalendar', 'CalendarioController@fullCalendar')->name('fullCalendar');

    //RH: Noticias
    Route::resource('noticias', 'NoticiasController')->except(['show']);
    Route::post('uiMantenimientoNoticia', 'NoticiasController@ui_mantenimiento_noticia');

    //RH: vacaciones
    Route::resource('vacaciones', 'VacacionesController')->except(['show']);
    Route::get('ui_calendario_vacaciones', 'VacacionesController@ui_calendario_vacaciones');
    Route::get('ui_motivo_vacaciones', 'VacacionesController@ui_motivo_vacaciones');
    Route::get('tab_reporte_vacaciones', 'VacacionesController@tab_reporte_vacaciones')->name('tab_reporte_vacaciones');
    Route::get('tab_vacaciones_coloboradores', 'VacacionesController@tab_vacaciones_coloboradores');

    //RH: Reclutamiento
    Route::resource('reclutamiento', 'ReclutamientoController')->only(['index']);

    //RH: Politica Empresa
    Route::resource('politicaEmpresarial', 'PoliticaEmpresarialController');

    //RH: Configuraciones
    Route::resource('rh_configuracion', 'ConfiguracionesController')->only(['index']);

    //RH: Configuraciones: Tipos Vacaciones
    Route::resource('rh_configuracionTipoSolicitudes', 'ConfiguracionesSolicitudesController')->except(['show']);

    //RH: Configuraciones: Dias Feriados
    Route::resource('rh_configuracionFeriados', 'ConfiguracionesFeriadosController')->except(['show']);

    //Reportes
    Route::resource('reportes', 'ReportesController')->only(['index']);

    //Facturacion
    Route::resource('facturacion', 'FacturacionController')->only(['index', 'edit', 'update']);
    Route::get('pagoFactura/{idRecarga}','FacturacionController@pagoFactura')->name('pagoFactura');
    Route::get('pagoFacturaSinpeMovil/{idRecarga}','FacturacionController@pagoFacturaSinpeMovil')->name('pagoFacturaSinpeMovil');
    Route::post('pagoEnLinea', 'FacturacionController@pagoEnLinea')->name('pagoEnLinea');
    Route::post('pagoFacturaPendiente', 'FacturacionController@pagoFacturaPendiente')->name('pagoFacturaPendiente');
    Route::post('descargarPdfFactura', 'FacturacionController@descargarPdfFactura')->name('descargarPdfFactura');
    Route::post('descargarXmlFactura', 'FacturacionController@descargarXmlFactura')->name('descargarXmlFactura');
    Route::post('descargarXmlMHFactura', 'FacturacionController@descargarXmlMHFactura')->name('descargarXmlMHFactura');
    Route::post('desactivarCargoAutomatico', 'FacturacionController@desactivarCargoAutomatico')->name('desactivarCargoAutomatico');

    //Adelanto de planilla
    Route::resource('generarAdelantoPlanilla', 'GenerarAdelantoPlanillaController')->except(['create', 'store']);
    Route::get('descargarTxtAdelantoPlanilla/{idPlanilla}','GenerarAdelantoPlanillaController@descargarTxtAdelantoPlanilla')->name('descargarTxtAdelantoPlanilla.download');
    Route::get('descargarExcelAdelantoPlanilla/{idPlanilla}','GenerarAdelantoPlanillaController@descargarExcelAdelantoPlanilla')->name('descargarExcelAdelantoPlanilla.download');
    Route::match(['put','patch'],'generarAdelantoPLanilla/{idPlanilla}','GenerarAdelantoPlanillaController@registrarAdelantoPlanilla')->name('registrarAdelantoPlanilla');

    //Generación de planilla
    Route::resource('generarPlanilla', 'GenerarPlanillaController')->except(['create', 'store']);
    Route::get('generarPlanilla/{id_tipo_planilla}/{id_moneda}', 'GenerarPlanillaController@crearPlanilla')->name('generarPlanilla.crear');
    Route::match(['put','patch'],'generarPLanilla/{idPlanilla}','GenerarPlanillaController@registrarPlanilla')->name('registrarPlanilla');
    Route::get('registrarPlanillaExtras','GenerarPlanillaController@registrarPlanillaExtras')->name('registrarPlanillaExtras');
    Route::get('obtenerDetalleDeducciones/{idPlanilla}/{idColaborador}/{moneda}','GenerarPlanillaController@obtenerDetalleDeducciones')->name('obtenerDetalleDeducciones.show');
    Route::get('obtenerDetalleOtrasDeducciones/{idPlanilla}/{idColaborador}/{totalOtrasDeducciones}','GenerarPlanillaController@obtenerDetalleOtrasDeducciones')->name('obtenerDetalleOtrasDeducciones.show');
    Route::get('guardarDetalleOtrasDeducciones','GenerarPlanillaController@guardarDetalleOtrasDeducciones')->name('guardarDetalleOtrasDeducciones.create');
    Route::post('guardarTotalOtrosRubrosIncrementos', 'GenerarPlanillaController@guardarTotalOtrosRubrosIncrementos')->name('guardarTotalOtrosRubrosIncrementos');
    Route::get('eliminarDetalleOtrasDeducciones','GenerarPlanillaController@eliminarDetalleOtrasDeducciones')->name('eliminarDetalleOtrasDeducciones.delete');
    Route::get('descargarTxtPlanilla/{idPlanilla}','GenerarPlanillaController@descargarTxtPlanilla')->name('descargarTxtPlanilla.download');
    Route::get('descargarExcelPlanilla/{idPlanilla}','GenerarPlanillaController@descargarExcelPlanilla')->name('descargarExcelPlanilla.download');

    //Historial planillas
    Route::get('historialPlanillas', 'HistorialPlanillaController@historialPlanillas')->name('historialPlanillas');
    Route::post('exportarExcelHistorialPlanillas', 'HistorialPlanillaController@exportarExcelHistorialPlanillas')->name('exportarExcelHistorialPlanillas');
    Route::get('detalleHistorialPlanilla/{idPlanilla}/{otroParametros?}', 'HistorialPlanillaController@detalleHistorialPlanilla')->name('detalleHistorialPlanilla');
    Route::post('detalleHistorialPlanilla/{idPlanilla}', 'HistorialPlanillaController@historialPlanilla_show')->name('detalleHistorialPlanillaPost');
    Route::post('exportarArchivoTxtBancoHistorialPlanilla', 'HistorialPlanillaController@exportarArchivoTxtBancoHistorialPlanilla')->name('exportarArchivoTxtBancoHistorialPlanilla');
    Route::post('exportarExcelDetalleHistorialPlanilla', 'HistorialPlanillaController@exportarExcelDetalleHistorialPlanilla')->name('exportarExcelDetalleHistorialPlanilla');
    Route::get('resumenHistorialPlanilla/{idPlanilla}/{idColaborador}', 'HistorialPlanillaController@historialPlanillas_resumen')->name('resumenHistorialPlanilla');
    Route::get('descargaArchivoBancario/{idPlanilla}', 'HistorialPlanillaController@descargaArchivoBancario')->name('descargaArchivoBancario');

    //Calculadora planilla
    Route::resource('calculadoraPlanilla', 'CalculadoraPlanillaController')->only(['index','show']);

    //Market place
    Route::resource('marketPlace','MarketPlaceController')->only(['index','edit']);
    Route::get('ui_contratar_servicios/{id_servicio}', 'MarketPlaceController@ui_contratar_servicios')->name('ui_contratar_servicios');
    Route::get('ui_servicio_config/{id_servicio}', 'MarketPlaceController@ui_servicio_config')->name('ui_servicio_config');
    Route::post('desactivar_servicio/{id_servicio}', 'MarketPlaceController@desactivar_servicio')->name('desactivar_servicio');

    //Impersonalizacion
    Route::resource('impersonalizacion','ImpersonalizacionController')->only(['index']);

    //Configuracion:Region
    Route::resource('region', 'RegionController')->only(['index']);

    //Configuracion:administracion de Empresa
    Route::resource('administracionEmpresa', 'AdministracionEmpresaController')->only(['edit', 'update']);
    Route::get('link_config_ocupaciones', 'AdministracionEmpresaController@link_config_ocupaciones')->name("link_config_ocupaciones");
    Route::get('empresaEliminarBanco/{idEmpresa}/{idBanco}', 'AdministracionEmpresaController@eliminarBanco')->name("empresaEliminarBanco");
    Route::put('puestosEmpresa/{idPuesto}', 'AdministracionEmpresaController@updatePuesto')->name('puestosEmpresa.update');
    Route::delete('puestosEmpresa/{idPuesto}', 'AdministracionEmpresaController@deletePuesto')->name('puestosEmpresa.delete');
    Route::put('accionPersonal/{idAccionPersonal}', 'AdministracionEmpresaController@updateAccionPersonal')->name('accionPersonal.update');
    Route::delete('accionPersonal/{idAccionPersonal}', 'AdministracionEmpresaController@deleteAccionPersonal')->name('accionPersonal.delete');
    Route::get('datos_generales', 'AdministracionEmpresaController@datos_generales')->name('datos_generales');
    Route::get('administracionEmpresa', 'AdministracionEmpresaController@administracionEmpresa_index')->name('administracionEmpresa');
    Route::get('tab_comunicaciones', 'AdministracionEmpresaController@tab_comunicaciones')->name('tab_comunicaciones');
    Route::get('tab_planilla', 'AdministracionEmpresaController@tab_planilla')->name('tab_planilla');
    Route::get('tab_bancos', 'AdministracionEmpresaController@tab_bancos')->name('tab_bancos');
    Route::get('tab_control_horario', 'AdministracionEmpresaController@tab_control_horario')->name('tab_control_horario');
    Route::get('tab_ocupaciones', 'AdministracionEmpresaController@tab_ocupaciones')->name('tab_ocupaciones');
    Route::get('tab_accion_personal', 'AdministracionEmpresaController@tab_accion_personal')->name('tab_accion_personal');
    Route::get('tab_sistema', 'AdministracionEmpresaController@tab_sistema')->name('tab_sistema');
    Route::put('updateAction/{idEmpresa}', 'AdministracionEmpresaController@updateAction')->name('updateAction');

    //Configuracion:usuarios
    Route::resource('usuario', 'UsuariosController')->except(['show']);

    //Configuracion:control de horarios
    Route::resource('miscelaneos', 'MiscelaneosController')->only(['index']);
    Route::resource('miscelaneosNotificacionesEmail', 'NotificacionesEmailController')->except(['index', 'show']);

    //Documentos
    Route::resource('documentos', 'DocumentosController')->only(['store','update']);

    //Cuenta
    Route::resource('miCuenta', 'MiCuentaController')->only(['edit', 'update']);
    Route::post('cambio_contrasena_usuario','MiCuentaController@cambio_contrasena_usuario')->name('cambio_contrasena_usuario');
    Route::post('actualizacion2FA','MiCuentaController@actualizacion2FA')->name('actualizacion2FA');

    //Funciones
    Route::get('cantidadVacaciones/{fechaInicio}/{fechaFinal}/{diasUsados}/{jornada}/', 'FuncionesController@obtenerDiasDisponibles')->name('cantidadVacaciones');
    Route::get('/descargarExcel/{nombreArchivo}','Herramientas\ExportarController@exportarArchivo')->name('descargaExcel');
    Route::get('/descargarArchivo/{rutaArchivo}','Herramientas\ExportarController@descargaArchivo')->name('descargarArchivo');

    //Graficos
    Route::post('grafico_planilla_mensual_colaboradores','HomeController@grafico_planilla_mensual_colaboradores')->name('grafico_planilla_mensual_colaboradores');
    Route::post('grafico_planilla_mensual','HomeController@grafico_planilla_mensual')->name('grafico_planilla_mensual');
    Route::post('grafico_planilla_mensual_aguinaldos','HomeController@grafico_planilla_mensual_aguinaldos')->name('grafico_planilla_mensual_aguinaldos');
    Route::get('grafico_ocupaciones','HomeController@grafico_ocupaciones')->name('grafico_ocupaciones');
    Route::get('grafico_ocupaciones_INS','HomeController@grafico_ocupaciones_INS')->name('grafico_ocupaciones_INS');

    // Reportes INS
    Route::get('/descargaINS/{id_planilla}','ReportesController@crear_documento_ins')->name('descargaINS');
    Route::get('/mostrar_variable_temp','ReportesController@mostrar_variable_temp')->name('mostrar_variable_temp');
    Route::get('/reporte_INS','ReportesController@tablaIns')->name('reporte_INS');
    Route::post('/eliminarTemp', 'ReportesController@eliminarTemp')->name('eliminarTemp');

    // TEST BANCOS
    Route::post('/extraer_cuenta', 'HelperController@extraer_cuenta')->name('extraer_cuenta');
    Route::get('/mostrar_test', 'HelperController@mostrar_test')->name('mostrar_test');

    // Carga de archivo colaboradores y descarga de Excel
    Route::post('/leerArchivo','ColaboradoresController@leerArchivo')->name('leerArchivo');
    Route::get('/descargar_excel', 'ColaboradoresController@descargar_excel')->name('descargar_excel');
});

//Funciones
Route::post('obtenerCantones/','FuncionesController@obtenerCantones')->name("obtenerCantones.index");
Route::post('obtenerDistritos/','FuncionesController@obtenerDistritos')->name("obtenerDistritos.index");
Route::post('obtenerBarrios/','FuncionesController@obtenerBarrios')->name("obtenerBarrios.index");
Route::post('obtenerNombre','FuncionesController@obtenerNombreCedula')->name("obtenerNombre.edit");
Route::post('obtenerNombreCedulaRegistro','FuncionesController@obtenerNombreCedulaRegistro')->name("obtenerNombreCedulaRegistro");
Route::get('testLarabug','FuncionesController@testLarabug')->name("testLarabug");

//Auth::routes();
//Nueva rutas login
Route::get('login', 'Autenticacion\UsuariosController@showLoginForm')->name('login');
Route::post('login', 'Autenticacion\UsuariosController@login');
Route::post('logout', 'Autenticacion\UsuariosController@logout')->name('logout');
Route::get('register', 'Autenticacion\UsuariosController@showRegistrationForm')->name('register');
Route::post('register', 'Autenticacion\UsuariosController@register');
Route::get('activacion-cuenta/{correo}','Autenticacion\UsuariosController@mostrarActivarUsuario');
Route::get('password/reset', 'Autenticacion\UsuariosController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Autenticacion\UsuariosController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Autenticacion\UsuariosController@resetPasswordUsuario');
Route::post('password/reset', 'Autenticacion\UsuariosController@reset')->name('password.update');
Route::post('cuentaActiva','Autenticacion\UsuariosController@cuentaActiva')->name('cuentaActiva');
Route::get('cuentaActiva','Autenticacion\UsuariosController@showLoginForm')->name('cuentaActiva');
Route::post('passwordReset','Autenticacion\UsuariosController@passwordReset')->name('passwordReset');
Route::get('passwordReset','Autenticacion\UsuariosController@showLoginForm')->name('passwordReset');
Route::get('two', 'Autenticacion\UsuariosController@showTwoFactorForm')->name('two');
Route::post('activar2FAlogin', 'Autenticacion\UsuariosController@activar2FAlogin')->name('activar2FAlogin');
Route::post('activar2FAlogin', 'Autenticacion\UsuariosController@activar2FAlogin')->name('activar2FAlogin');
Route::post('enviarCodigo', 'Autenticacion\UsuariosController@enviarCodigo')->name('enviarCodigo');
Route::post('verificar2FA', 'Autenticacion\UsuariosController@verificar2FA')->name('verificar2FA');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['authNormal']);
Route::get('/calculadora', [App\Http\Controllers\HomeController::class, 'calculadora'])->name('calculadora')->middleware(['authNormal']);
Route::get('/chequeo', [App\Http\Controllers\HomeController::class, 'chequeo'])->name('chequeo')->middleware(['authNormal']);
Route::get('/cargar_graficos', [App\Http\Controllers\HomeController::class, 'cargar_graficos'])->name('cargar_graficos')->middleware(['authNormal']);

//Herramienta imagenes y documentos
Route::controller(DropzoneController::class)->group(function(){

    Route::get('dropzone', 'index');

    Route::post('dropzone/store', 'store')->name('dropzone.store');

    Route::post('dropzone/delete', 'delete')->name('dropzone.delete');
});

//Imagenes
Route::controller(ImageController::class)->group(function(){
    Route::get('image/{dir_group}/{filename}', 'show')->name('image.show');
    Route::get('image/{id_empresa}/{dir_group}/{filename}', 'show_image_empresa')->name('image_empresa.show');
});

//Archivos
Route::controller(FileController::class)->group(function(){
    Route::get('file/{dir_group}/{filename}', 'show')->name('file.show');
    Route::get('file/{id_empresa}/{dir_group}/{filename}', 'show_file_empresa')->name('file_empresa.show');
});

Route::post('upload/store', [UploadController::class, 'store'])->name('upload.store')->middleware(['authNormal']);
Route::post('upload/delete', [UploadController::class, 'delete'])->name('upload.delete')->middleware(['authNormal']);
