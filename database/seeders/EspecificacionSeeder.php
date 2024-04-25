<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\ConditionType;
use App\Models\BeltMaterial;  
use App\Models\BoxShape;
use App\Models\Calendar;
use App\Models\TypeReloj;
use App\Models\Invoice;

use Illuminate\Database\Seeder;

class EspecificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $geeders = [ 
            ['name' => 'Hombre'],
            ['name' => 'Mujer'],
            ['name' => 'Unisex']
        ];

        $box_shapes = [ 
            ['name' => 'Circular'],
            ['name' => 'Corazón'],
            ['name' => 'Cuadrada'],
            ['name' => 'Decagono'],
            ['name' => 'Flor'],
            ['name' => 'Hexagonal'],
            ['name' => 'Octagonal'],
            ['name' => 'Ovalada'],
            ['name' => 'Pentagonal'],
            ['name' => 'Rectangular'],
            ['name' => 'Rombo'],
            ['name' => 'Triangular']
        ];

        $belt_materials = [  
            ['name' => 'Acero'],
            ['name' => 'Acero Inoxidable'],
            ['name' => 'Acetato'],
            ['name' => 'Acrilico'],
            ['name' => 'Algodón'],
            ['name' => 'Aluminio'],
            ['name' => 'Baño de Oro'],
            ['name' => 'Carey'],
            ['name' => 'Caucho'],
            ['name' => 'Cerámica'],
            ['name' => 'Charol'],
            ['name' => 'Correa'],
            ['name' => 'Cuerina'],
            ['name' => 'Cuero'],
            ['name' => 'Cuero Sintético'],
            ['name' => 'Goma'],
            ['name' => 'Jean'],
            ['name' => 'Jebe'],
            ['name' => 'Latón'],
            ['name' => 'Lienzo'],
            ['name' => 'Madera'],
            ['name' => 'Metal'],
            ['name' => 'Nylon'],
            ['name' => 'Oro Rosa'],
            ['name' => 'Plasteramic'],
            ['name' => 'Plastico'],
            ['name' => 'Plata'],
            ['name' => 'Policarbonato'],
            ['name' => 'Poliuretano'],
            ['name' => 'Poliéster'],
            ['name' => 'Resina'],
            ['name' => 'Satén'],
            ['name' => 'Silicona'],
            ['name' => 'Sintético'],
            ['name' => 'Titanio'],
            ['name' => 'Velcro']
        ];

        $type_relojs =[
            ['name' => 'Análogo'],
            ['name' => 'Análogo-Digital'],
            ['name' => 'Digital'],
            ['name' => 'Digital-Táctil']
        ];

        $calendars=[
            ['name' => 'Cronógrafo'],
            ['name' => 'No'],
            ['name' => 'Si']
        ];

        $condition_types=[
            ['name' => 'Nuevo'],
            ['name' => 'Reacondicionado']
        ];
    
        $invoices=[
            ['name' => 'Boleta'],
            ['name' => 'Factura']
        ];

        foreach ($geeders as $geeder) { 
            Gender::create($geeder); 
        }
        foreach ($condition_types as $condition_type) { 
            ConditionType::create($condition_type); 
        }
        foreach ($belt_materials as $belt_material) { 
            BeltMaterial::create($belt_material); 
        }
        foreach ($box_shapes as $box_shape) { 
            BoxShape::create($box_shape); 
        }
        foreach ($calendars as $calendar) { 
            Calendar::create($calendar); 
        }
        foreach ($type_relojs as $type_reloj) { 
            TypeReloj::create($type_reloj); 
        }
        foreach ($invoices as $invoice) { 
            Invoice::create($invoice); 
        }

    }
}
