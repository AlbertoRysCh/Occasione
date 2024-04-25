<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('public/categories');
        Storage::makeDirectory('public/categories');
        
        Storage::deleteDirectory('public/subcategories');
        Storage::makeDirectory('public/subcategories');
        
        Storage::deleteDirectory('public/products');
        Storage::makeDirectory('public/products');
        
        //NUEVAS CARPETAS
        
        Storage::deleteDirectory('public/access_fronts');
        Storage::makeDirectory('public/access_fronts');
        
        Storage::deleteDirectory('public/bannertops');
        Storage::makeDirectory('public/bannertops');
        
        Storage::deleteDirectory('public/bells');
        Storage::makeDirectory('public/bells');
        
        Storage::deleteDirectory('public/cardbanners');
        Storage::makeDirectory('public/cardbanners');
        
        Storage::deleteDirectory('public/footers');
        Storage::makeDirectory('public/footers');
        
        Storage::deleteDirectory('public/logos');
        Storage::makeDirectory('public/logos');
        
        Storage::deleteDirectory('public/minibanner');
        Storage::makeDirectory('public/minibanner');

        Storage::deleteDirectory('public/paises');
        Storage::makeDirectory('public/paises');

        Storage::deleteDirectory('public/pdf');
        Storage::makeDirectory('public/pdf');

        Storage::deleteDirectory('public/sliders');
        Storage::makeDirectory('public/sliders');

        Storage::deleteDirectory('public/subbaners');
        Storage::makeDirectory('public/subbaners');


        $this->call(UserSeeder::class);
        /*$this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);
        
        $this->call(ProductSeeder::class);

        $this->call(ColorSeeder::class);
        $this->call(ColorProductSeeder::class);

        $this->call(SizeSeeder::class);

        $this->call(ColorSizeSeeder::class);

        $this->call(DepartmentSeeder::class);*/

        //Ocultar
        $this->call(FotterSeeder::class);
        $this->call(ProductionPaisSeeder::class);
        $this->call(AccessFrontSeeder::class);
    }
}
