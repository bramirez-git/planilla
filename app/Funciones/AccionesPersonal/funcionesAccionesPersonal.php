<?php
namespace App\Funciones\AccionesPersonal;

use App\Funciones\Storage\cls_storage;
use App\Funciones\Storage\TempDir;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class funcionesAccionesPersonal
{
    public function obtenerParametrosGenerales(Request $request,$id_colaborador,$codigos,$subcodigos)
    {
        $subAccion = explode("-", $request["subTipoAccion"])[0];

        $tipo_fechas="";
        $fechas1="";
        $fechas2="";
        $ultimoMesSalarioBruto="";
        $deducciones="";
        $salarioNeto="";
        $ocupacion="";
        $documentos="";
        $tipo="";
        $descripcion="";
        $numeroBoleta="";
        $aplicaAumentoSalarial="";
        $nuevoSalarial="";
        $hora = "";
        $diasVacaciones="";
        $montoVacaciones="";
        $aguinaldoAcumulado="";
        $asociacionSolidarista="";
        $preaviso="";
        $cesantia="";
        $porcentaje_salario="";


        switch($codigos[0])
        {
            case 1:
                $this->obtenerParametrosAmonestaciones($request,$subAccion,$tipo_fechas,$fechas1,$fechas2,$tipo,$documentos,$descripcion,$id_colaborador);
                break;
            case 2:
                $this->obtenerParametrosConstancias($request,$subAccion, $tipo_fechas,$fechas1,$fechas2,$ocupacion,$ultimoMesSalarioBruto,$deducciones,$salarioNeto);
                break;
            case 3:
                $this->obtenerParametrosIncapacidades($request, $tipo_fechas,$fechas1,$documentos,$numeroBoleta,$id_colaborador);
                break;
            case 4:
                $this->obtenerParametrosLicencias($request, $tipo_fechas,$fechas1,$documentos,$numeroBoleta,$id_colaborador);
                break;
            case 5:
                $this->obtenerParametrosModificacionSalarial($request, $tipo_fechas,$fechas1,$aplicaAumentoSalarial,$nuevoSalarial,$ocupacion);
                break;
            case 6:
                $this->obtenerParametrosPermisos($request,$subAccion, $tipo_fechas,$fechas1,$hora,$documentos,$porcentaje_salario,$id_colaborador);
                break;
            case 7:
                $this->obtenerParametrosTerminacionContrato($request,$subAccion, $tipo_fechas,$fechas1,$ultimoMesSalarioBruto,$diasVacaciones,$montoVacaciones,$aguinaldoAcumulado,$deducciones,$asociacionSolidarista,$preaviso,$cesantia,$descripcion);
                break;
            case 8:
                $this->obtenerParametrosVacaciones($request,$subAccion,$tipo_fechas,$fechas1,$documentos,$id_colaborador,$diasVacaciones);
                break;
        }

        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => $id_colaborador,
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_empresa_categoria' => $codigos[1],
            'id_empresa_subcategoria' => $subcodigos[0],
            'tipo_fechas'=> $tipo_fechas,
            'fechas1'=> $fechas1,
            'hora'=> $hora,
            'fechas2'=> $fechas2,
            'tipo'=> $tipo,
            'ocupacion'=> $ocupacion,
            'salario_bruto'=> $ultimoMesSalarioBruto,
            'deducciones'=> $deducciones,
            'salario_neto'=> $salarioNeto,
            'boleta'=> $numeroBoleta,
            'aumento'=> $aplicaAumentoSalarial,
            'nuevo_salario'=> $nuevoSalarial,
            'dias_vacaciones'=> $diasVacaciones,
            'monto_vacaciones'=> $montoVacaciones,
            'aguinaldo'=> $aguinaldoAcumulado,
            'asociacion_solidarista'=> $asociacionSolidarista,
            'monto_preaviso'=> $preaviso,
            'monto_cesantia'=> $cesantia,
            'comentarios'=> $descripcion,
            'documentos'=> $documentos,
            'porcentaje'=>$porcentaje_salario,
        ];

        //$otrosRebajos="";

        //dd($conjuntoParametros);

        return $conjuntoParametros;
    }

    public function obtenerParametrosAmonestaciones(Request $request,$subAccion,&$tipo_fechas,&$fechas1,&$fechas2,&$tipo,&$documentos,&$descripcion,$id_colaborador)
    {
        //hace todo el proceso correspondiente a los documentos adjuntos
        $nombreDocumento= $this->documentosFuncion($request);

        switch($subAccion) {
            case 1:
                $tipo_fechas="fechas";
                $fechas1= trim($request['fechaAmonestacion']);
                $documentos = $nombreDocumento;
                $tipo= trim($request['afectaGoce']);
                $descripcion= trim($request['descripcion']);
                break;
            case 2:
                $tipo_fechas="fechas";
                $fechas1= trim($request['fechaAmonestacion']);
                $documentos = $nombreDocumento;
                $tipo= trim($request['afectaGoce']);
                break;
            case 3:
                $tipo_fechas="fechas";
                $fechas1= trim($request['fechaAmonestacion']);
                $fechas2= trim($request['fechaSuspension']);
                $tipo= trim($request['afectaGoce']);
                $documentos = $nombreDocumento;
                break;
            case 4:
                $tipo_fechas="fechas";
                $fechas1= trim($request['fechaAmonestacion']);
                $documentos = $nombreDocumento;
                break;
        }
    }

    public function obtenerParametrosConstancias(Request $request,$subAccion,&$tipo_fechas,&$fechas1,&$fechas2,&$ocupacion,&$UltimoMesSalarioBruto,&$Deducciones,&$SalarioNeto)
    {
        switch($subAccion)
        {
            case 5:
                $tipo_fechas="fechas";
                $fechas1= trim($request['fechaInicioLabores']);
                $ocupacion = trim($request['ocupacion']);
                break;
            case 6:
                $tipo_fechas="fechas";
                $fechas1= trim($request['fechaInicioLabores']);
                $fechas2= trim($request['fechaSalida']);
                $ocupacion = trim($request['ocupacion']);
                break;
            case 7:
                $tipo_fechas="fechas";
                $fechas1= trim($request['fechaInicioLabores']);
                $UltimoMesSalarioBruto= trim($request['ultimoSalarioBruto']);
                $Deducciones= trim($request['deducciones']);
                $SalarioNeto= trim($request['salarioNeto']);
                $ocupacion = trim($request['ocupacion']);
                break;
        }
    }

    public function obtenerParametrosIncapacidades($request, &$tipo_fechas,&$fechas1,&$documentos,&$numeroBoleta,$id_colaborador)
    {
        //Seleccion de fechas
        if (!(trim($request["seleccionFechas"]) == "")) {
            $tipo_fechas = "fechas";
            $fechas1 = trim($request["seleccionFechas"]);
        } else {
            $tipo_fechas = "rango";
            $fechas1 = trim($request["fechaInicial"]) . "|" . trim($request["fechaFinal"]);
        }

        //Numero de boleta
        $numeroBoleta=trim($request["numeroBoleta"]);

        //hace todo el proceso correspondiente a los documentos adjuntos
        $documentos= $this->documentosFuncion($request);
    }

    public function obtenerParametrosLicencias($request, &$tipo_fechas,&$fechas1,&$documentos,&$numeroBoleta,$id_colaborador)
    {
        //Seleccion de fechas
        if (!(trim($request["seleccionFechas"]) == "")) {
            $tipo_fechas = "fechas";
            $fechas1 = trim($request["seleccionFechas"]);
        } else {
            $tipo_fechas = "rango";
            $fechaString = explode("/", $request["fechaInicial"]);
            $fechaInicial = $fechaString[2].'-'.$fechaString[1].'-'.$fechaString[0];

            $fechaString = explode("/", $request["fechaFinal"]);
            $fechaFinal = $fechaString[2].'-'.$fechaString[1].'-'.$fechaString[0];
            $fechas1 = trim($fechaInicial) . "|" . trim($fechaFinal);
        }

        //Numero de boleta
        $numeroBoleta=trim($request["numeroBoleta"]);

        //hace todo el proceso correspondiente a los documentos adjuntos
        $documentos= $this->documentosFuncion($request);
    }

    public function obtenerParametrosModificacionSalarial($request, &$tipo_fechas,&$fechas1,&$aplicaAumentoSalarial,&$nuevoSalarial,&$ocupacion)
    {
        $tipo_fechas="fechas";
        $fechas1= trim($request['fechaRegimiento']);
        $aplicaAumentoSalarial=$request['aplicaAumentoSalarial'];
        if($aplicaAumentoSalarial==1)
        {
            $nuevoSalarial = $request['nuevoSalarioBase'];
        }
        $ocupacion=$request['puesto'];
    }

    public function obtenerParametrosPermisos($request,$subAccion, &$tipo_fechas,&$fechas1,&$hora,&$documentos,&$porcentaje_salario,$id_colaborador)
    {
        //hace todo el proceso correspondiente a los documentos adjuntos
        $documentos= $this->documentosFuncion($request);
        $tipo_fechas="fechas";
        $fechas1= trim($request['seleccionFechas']);

        if($subAccion==17)
        {
            $hora= trim($request['hora']);
        }
        if($subAccion==15)
        {
            if(isset($request['porcentaje_salario']))
            {
                $porcentaje_salario= trim($request['porcentaje_salario']);
            }
            else{
                $porcentaje_salario=100;
            }
        }
    }

    public function obtenerParametrosTerminacionContrato($request,$subAccion, &$tipo_fechas,&$fechas1,&$UltimoMesSalarioBruto,&$diasVacaciones,&$montoVacaciones,&$aguinaldoAcumulado,&$otrosRebajos,&$asociacionSolidarista,&$preaviso,&$cesantia,&$descripcion)
    {
        $tipo_fechas="fechas";
        $fechas1= trim($request['fechaSalida']);
        $UltimoMesSalarioBruto= trim($request['salarioBruto']);
        $diasVacaciones = trim($request['diasVacaciones']);
        $montoVacaciones = trim($request['montoVacaciones']);
        $aguinaldoAcumulado = trim($request['aguinaldoAcumulado']);
        $otrosRebajos = trim($request['otrosRebajos']);
        $asociacionSolidarista = trim($request['asociacionSolidarista']);

        if($subAccion==19) {
            $preaviso = trim($request['preaviso']);
            $cesantia = trim($request['cesantia']);
        }

        if($subAccion==19||$subAccion==21) {
            $cesantia = trim($request['cesantia']);
        }
        $descripcion = trim($request['descripcion']);
    }

    public function obtenerParametrosVacaciones($request,$subAccion, &$tipo_fechas,&$fechas1,&$documentos,$id_colaborador,&$diasVacaciones)
    {
        //hace todo el proceso correspondiente a los documentos adjuntos
        $documentos= $this->documentosFuncion($request);
        $tipo_fechas="fechas";

        if($subAccion==22)
        {
            $diasVacaciones=trim($request['cantidadDias']);
        }
        else{
            $fechas1= trim($request['fecha']);
        }
    }

    public function documentosFuncion(Request $request)
    {
        $nombreDocumento = "" ;
        if(session()->get('documentos')!="")
        {
            $directorio = session()->get('documentos');

            // Verificar si el directorio existe
            if (File::isDirectory($directorio)) {
                // Obtener la lista de archivos en el directorio
                $archivos = File::files($directorio);

                // Iterar sobre cada archivo
                foreach ($archivos as $archivo)
                {
                    // Obtener la ruta del archivo y la ruta del directorio
                    $rutaArchivo = $archivo->getRealPath();
                    $rutaDirectorio = $archivo->getPath();

                    // Obtener la extensión del archivo
                    $extension = pathinfo($rutaArchivo, PATHINFO_EXTENSION);

                    //Nuevo nombre del archivo
                    $nuevoNombre=cls_storage::filename_doc($extension);
                    rename($rutaArchivo, $rutaDirectorio.'/'.$nuevoNombre);

                    //Crea el directorio
                    $dir=cls_storage::dir_warehouse_acciones_personal( $request->session()->get('id_cliente'));


                    //lo mueve al directorio nuevo
                    File::move($rutaDirectorio.'/'.$nuevoNombre, $dir.$nuevoNombre);

                    //asigna la ruta al string para guardar en la bd
                    $nombreDocumento .= $dir.$nuevoNombre.",";
                }
                $nombreDocumento = substr($nombreDocumento,0,-1);
                TempDir::destroy_dir(session()->get('documentos'));
            }
        }

        return $nombreDocumento;
    }

}
