<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoicesExport implements FromQuery,ShouldQueue
{
    use Exportable;
    // public $table_name;

    // public function __construct($table_name)
    // {
    // 	$this->table_name = $table_name;
    // }

    public function query()
    {
        return Invoice::query();
    }
}