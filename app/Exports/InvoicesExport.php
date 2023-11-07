<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoicesExport implements FromCollection
{
    protected $month;


    public function __construct($month)
    {
        $this->month = 9;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Order::whereMonth('created_at','=', $this->month)->get();
    }
}
