<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Color;
use App\Models\Size;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Los seeder se borran cuando hacemos las migracion y se vuelven a crear para no dejar imagenes restantes
        Storage::deleteDirectory('categories');
        Storage::deleteDirectory('subcategories');
        Storage::deleteDirectory('products');
    
        //crea las carpetas
        Storage::makeDirectory('categories');
        Storage::makeDirectory('subcategories');
        Storage::makeDirectory('products');

        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);
    
        $this->call(ProductSeeder::class);

        $this->call(ColorSeeder::class);
        $this->call(ColorProductSeeder::class);

        $this->call(SizeSeeder::class);
    
        $this->call(ColorSizeSeeder::class);

        $this->call(DepartmentSeeder::class);
    }
}
