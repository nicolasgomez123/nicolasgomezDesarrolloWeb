<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Department;
use App\Models\District;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    //la fabrica en donde pedimos que cree los elementos definidos en factory
    {
        Department::factory(8)->create()->each(function(Department $department){//each va a iterar los registros
            City::factory(8)->create([ //que se creen 8 ciudades
                'department_id' => $department->id //queremos su id
            ])->each(function(City $city){
                District::factory(8)->create([
                    'city_id' => $city->id
                ]);
            });
        });
    }
}
