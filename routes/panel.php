<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Panel Routes
|--------------------------------------------------------------------------
|
*/
$rutaPanel = "Panel";
$rutaHerramientas = "Herramientas";

//establece como principal el inicio de sesion
Route::get('/', $rutaPanel.'\Login\LoginAdminController@showLoginForm')->name("panel");
Route::post('/panelLogin', $rutaPanel.'\Login\LoginAdminController@panelLogin')->name("panelLogin");
Route::post('/panelLogout', $rutaPanel.'\Login\LoginAdminController@panelLogout')->name("panelLogout");

Route::group(['middleware' => ['authWS']], function() {

    $rutaPanel = "Panel";
    $rutaHerramientas = "Herramientas";

    //Aqui se tendran las rutas para herramientas como exportar
    Route::get('/descargarExcel/{nombreArchivo}',$rutaHerramientas.'\ExportarController@exportarArchivo')->name('descargarExcel');


    //Aquí se tendrán rutas para modulos

    //Clientes
    Route::resource('/clientes', $rutaPanel.'\ClientesPanelController')->except(['create','edit']);
    Route::post('/activar-cuenta',$rutaPanel.'\ClientesPanelController@activarCuenta')->name('activar-cuenta');
    Route::post('/descargar_excel_cliente',$rutaPanel.'\ClientesPanelController@descargar_excel')->name('descargar_excel_cliente');

    //Reportes
    Route::resource('/reportes', $rutaPanel.'\ReportesPanelController')->only(['index']);

    Route::resource('/noticiasPanel', $rutaPanel.'\NoticiasPanelController')->except(['show']);
    Route::post('/descargar_excel_noticias',$rutaPanel.'\NoticiasPanelController@descargar_excel')->name('descargar_excel_noticias');

    //Configuracion
    Route::resource('/configuracion', $rutaPanel.'\ConfiguracionPanelController')->only(['index']);

    //Configuracion: deducciones patronales
    Route::resource('/configuracionDeduccionPatronal', $rutaPanel.'\DeduccionesPatronalesController')->only(['edit', 'update']);

    //Configuracion: impuestos Renta
    Route::resource('/configuracionImpuestosRenta', $rutaPanel.'\ImpuestosRentaController')->only(['edit', 'update']);

    //Configuracion: creditos Fiscales Familiares
    Route::resource('/configuracionCreditoFamiliar', $rutaPanel.'\CreditosFiscalesFamiliaresController')->only(['edit', 'update']);

    //Configuracion: entidades Financieras
    Route::resource('/configuracionEntidadesFinancieras', $rutaPanel.'\EntidadesFinancierasController')->except(['show', 'create']);

    //Configuracion: catalogo ins
    Route::resource('/configuracionCatalogoINS', $rutaPanel.'\CatalogoINSController')->except(['update','edit','show']);
    Route::get('/descargarPlantilla',$rutaPanel.'\CatalogoINSController@descargarPlantilla')->name('descargarPlantilla');
    Route::post('/descargar_excel_catalogo_INS',$rutaPanel.'\CatalogoINSController@descargar_excel')->name('descargar_excel_catalogo_INS');

    //Configuracion: salario minimo
    Route::resource('/configuracionSalarioMinimo', $rutaPanel.'\SalarioMinimoController')->only(['edit','update']);

    //Configuracion: catalogo ccss
    Route::resource('/configuracionCatalogoCCSS', $rutaPanel.'\CatalogoCCSSController')->except(['update','edit','show']);
    Route::get('/plantillaCatalogoCCSS',$rutaPanel.'\CatalogoCCSSController@plantillaCatalogoCCSS')->name('plantillaCatalogoCCSS');
    Route::post('/descargar_excel_CCSS',$rutaPanel.'\CatalogoCCSSController@descargar_excel')->name('descargar_excel_CCSS');

    //Configuracion: catalogo accion Personal
    Route::resource('/configuracionAccionPersonal', $rutaPanel.'\AccionPersonalController')->except(['create','show']);
    Route::put('/updateCategoria',$rutaPanel.'\AccionPersonalController@updateCategoria')->name('configuracionAccionPersonal.updateCategoria');

    //Configuracion: catalogo ins
    Route::resource('/configuracionCatalogoFeriados', $rutaPanel.'\CatalogoFeriadosController')->except(['show']);

    //Configuracion: padron completo
    Route::resource('/configuracionPadronCompleto', $rutaPanel.'\PadronCompletoController')->except(['show']);
    Route::post('/configuracionPadronCompleto', $rutaPanel.'\PadronCompletoController@padron_show')->name('padron_show');
    Route::post('/cargarPadronElectoral', $rutaPanel.'\PadronCompletoController@cargarPadronElectoral')->name('cargarPadronElectoral');
    Route::post('/guardarPadronElectoral', $rutaPanel.'\PadronCompletoController@guardarPadronElectoral')->name('guardarPadronElectoral');
    Route::post('/descargarExcelPadron', $rutaPanel.'\PadronCompletoController@descargarExcelPadron')->name('descargarExcelPadron');

    //Miscelaneos
    Route::resource('/panelMiscelaneos', $rutaPanel.'\MiscelaneosController')->only(['index']);
    Route::resource('/panelMiscelaneosNotificaciones', $rutaPanel.'\NotificacionesEmailController')->except(['index', 'show']);

    //Usuarios
    Route::resource('/usuarios', $rutaPanel.'\UsuariosPanelController')->only(['index']);

    //MarketPlace
    Route::resource('/marketplace', $rutaPanel.'\Marketplace\MarketplacePanelController')->only(['index']);
    Route::resource('/marketplace', $rutaPanel.'\Marketplace\ProductoMarketplaceController')->except(['index', 'show']);
    Route::post('/descargar_excel_marketplace',$rutaPanel.'\Marketplace\MarketplacePanelController@descargar_excel')->name('descargar_excel_marketplace');
});





