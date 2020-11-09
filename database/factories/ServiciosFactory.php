<?php

namespace Database\Factories;

use App\Models\Servicios;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiciosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Servicios::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence(),
            'descripcion_corta' => $this->faker->text(200),
            'descripcion_larga' => $this->faker->text(100),
            'foto' => 'fotos/servicios/'.$this->faker->image('public/storage/fotos/servicios',400,300, null, false),
            'precio_rebajado' => $this->faker->randomNumber(4),
            'precio_normal' => $this->faker->randomNumber(4),
            'dias_pruebas' => $this->faker->randomNumber(2),
            'dias_suspender' => $this->faker->randomNumber(1),
            'dias_notificar' => $this->faker->randomNumber(1),
            'ciclo_facturacion' => $this->faker->randomElement(array(1,3,6,12))
        ];
    }
}
