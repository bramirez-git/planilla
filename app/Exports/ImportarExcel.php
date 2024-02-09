<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportarExcel implements ToCollection
{
    public function collection(Collection $rows)
    {
    }
}
