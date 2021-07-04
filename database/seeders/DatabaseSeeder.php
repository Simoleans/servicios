<?php

namespace Database\Seeders;

use App\Models\CicloServicio;
use App\Models\Team;
use App\Models\User;
use App\Models\Producto;
use App\Models\Servicios;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {       
        Producto::factory(10)->create();
        Servicios::factory(10)
        ->has(CicloServicio::factory()->count(3), 'ciclos')
        ->create();
        User::factory(1)->create();
        Team::factory(1)->create();
        
    }
}
