<?php

namespace App\Exports;

use App\Models\Maintenance;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class MaintenanceExport implements FromView
{
    public $start, $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
   public function view(): View
    {
        $start = $this->start;
        $end = $this->end;
        
        $data = Maintenance::select([
            'maintenances.created_at AS fecha',
            'customers.business_name AS cliente',
            'customers.rut AS rut',
            'customers.name AS contacto',
            'customers.email AS email',
            'customers.phone AS telefono',
            'maintenances.description AS description',
            'maintenances.subtotal AS subtotal',
            'maintenances.iva AS iva',
            'maintenances.discount_percent AS descuento',
            'maintenances.discount AS descuento_total',
            'maintenances.grand_total AS grand_total',
            'maintenances.start_date_maintenance AS start_date_maintenance',
            'maintenances.end_date_maintenance AS end_date_maintenance',
            'maintenances.time_recordatory AS time_recordatory',
            'maintenances.status AS status',
        ])->leftJoin('customers', 'customers.id', '=', 'maintenances.customer_id')
        ->where(function ($query) use ($start, $end) {
            if ($start != '' && $end != '') {
                $query->whereBetween('maintenances.created_at', [$start, $end]);
            }
        })
        ->orderBy('maintenances.created_at', 'desc')
        ->get();
        return view('maintenances.excel', compact('data', 'start', 'end'));
    }
}
