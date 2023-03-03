<?php

namespace App\Exports;

use App\TestExport as Texport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class TestExport implements FromQuery,ShouldQueue
{
    public function query()
    {
        return Texport::query();
    }
}