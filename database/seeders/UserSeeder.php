<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        
        
        //datos de usuarios

        //usuario principal
        User::create([
            'name' => 'pedro Gomez',
            'email' => 'nicolasgomez@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('admin');//le asignamos el rol de administrador
    
        //cree usuarios de prueba
        User::factory(100)->create();
    
    }
}
