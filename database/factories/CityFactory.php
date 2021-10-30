<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //datos de prueba
        return [
            'name' => $this->faker->word(), //faker nos trae una palabra
            'cost' => $this->faker->randomElement([5, 10, 15]) //faker nos trae valores randoms entre los numeros dentro del array
            
        ];
    }
}
