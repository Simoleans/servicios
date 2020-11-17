<?php

namespace Database\Factories;

use App\Models\Servicios;
use App\Models\CicloServicio;
use Illuminate\Database\Eloquent\Factories\Factory;

class CicloServicioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CicloServicio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'servicio_id' =>  Servicios::factory(),
            'mes' => $this->faker->randomElement(array(1,3,6,12)),
            'porcentaje' => $this->faker->randomElement(array(10,15,20)),
        ];
    }
}
