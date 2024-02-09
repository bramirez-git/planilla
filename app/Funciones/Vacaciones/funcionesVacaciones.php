<?php

namespace App\Funciones\Vacaciones;

use DateTime;

trait funcionesVacaciones
{
    public function getDiasDisponibles($fechaInicio,$fechaFinal,$diasUsados,$jornada)
    {
        $contador = date_diff(date_create($fechaInicio), date_create($fechaFinal));
        $meses = $contador->format('%m');
        $years = $contador->format('%y');
        $meses = $meses+($years*12);

        $diasDisponibles = 0;

        if($jornada == 1)
        {
            if($meses>=0 && $meses<=60)
            {
                $diasDisponibles = 0.833*$meses;
            }
            else if($meses>60 && $meses<=120)
            {
                $diasDisponibles = 1*$meses;
            }
            else if($meses>120 && $meses<=180)
            {
                $diasDisponibles = 1.2*$meses;
            }
            else if($meses>180 && $meses<=720)
            {
                $diasDisponibles = 2*$meses;
            }
        }

        if($jornada == 2)
        {
            if($meses>=0 && $meses<=720)
            {
                $diasDisponibles = 1*$meses;
            }
        }

        if($jornada == 3)
        {
            if($meses>=0 && $meses<=720)
            {
                $diasDisponibles = 0.25*$meses;
            }
        }

        $diasDisponibles = $diasDisponibles-$diasUsados;
        $diasDisponibles2 = $this->truncateFloat($diasDisponibles,0);

        //si es mayor a .5 redondea a .5
        if($diasDisponibles >= ($diasDisponibles2 + 0.5))
        {
            $diasDisponibles2 =$diasDisponibles2 + 0.5;
        }


        return ['cantidadDias' => $diasDisponibles2,'valorExacto' => $diasDisponibles,'meses' => $meses];
    }

    function truncateFloat($number, $digitos)
    {
        $raiz = 10;
        $multiplicador = pow ($raiz,$digitos);
        $resultado = ((int)($number * $multiplicador)) / $multiplicador;
        return number_format($resultado, $digitos);

    }
}
