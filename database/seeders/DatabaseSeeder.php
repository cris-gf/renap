<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Person;
use App\Models\Request;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Crear administrador
        User::create([
            'name'     => 'Administrador RENAP',
            'email'    => 'renap@admin.com',
            'password' => bcrypt('123456')
        ]);
        //Crear 10 personas y solicitudes
        Person::factory()->count(10)->create();
        Request::factory()->count(10)->create();
    }
}
