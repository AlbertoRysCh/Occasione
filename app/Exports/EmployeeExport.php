<?php

namespace App\Exports;

use App\Models\District;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection,WithHeadings
{
    public function headings():array{
        return[
            'idDepart',
            'nameDepart',
            'idCity',
            'nameCity',
            'idDist',
            'nameDist',
            'cost',
            'cost_international',
            'days_received',
            'days_late'
        ];   
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return AppModelsDistrict::all();
        return collect(District::getDistrict());
    }
}
