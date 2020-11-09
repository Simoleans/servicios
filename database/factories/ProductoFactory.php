<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

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
            'foto' => 'fotos/productos/'.$this->faker->image('public/storage/fotos/productos',400,300, null, false),
            'precio_rebajado' => $this->faker->randomNumber(4),
            'precio_normal' => $this->faker->randomNumber(4)
        ];
    }
}
