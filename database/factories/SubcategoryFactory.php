<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subcategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            return [                                  //carpeta en donde se almacenan la imagenes de los factories
                'image' => 'subcategories/' . $this->faker->image('public/storage/subcategories', 640, 480, null, false)
            ];
        
    }
}
