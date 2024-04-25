<?php

namespace Database\Seeders;

use App\Models\Footer;
use Illuminate\Database\Seeder;
 
class FotterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $footers = [
            /* Celulares y tablets */
            [ 
                'color_footer' => '#eeeeee',
                'color_texto_footer' => 'black',
                'color_subtexto_footer' => '#16537e',
                'image' => 'footers/1640956967.png'
            ], 
        ];

        foreach ($footers as $footer) {
            

            Footer::create($footer);

        }
    }
}
