<?php

namespace Database\Seeders;

use App\Models\AccessFront;
use Illuminate\Database\Seeder;

class AccessFrontSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $access_front = [
            /* Celulares y tablets */
            [ 
                'color_fondo_access' => '#eeeeee',
                'color_card_access' => 'white',
                'color_card_line_access' => '#f44336',
                'color_card_hover_access' => '#f4cccc',
                'color_card_border_access' => '#f4cccc',
                'color_card_text_access' => '#0b5394',
                'color_card_text_hover_access' => '#0b5394',
                'color_card_enlace_access' => '#3d85c6',
                'image' => 'access_fronts/1640956967.svg' 
            ], 
        ];

        foreach ($access_front as $item) {  
            AccessFront::create($item);
        }
    }
}
