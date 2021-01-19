<?php

namespace Database\Factories;

use App\Models\Request;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Request::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //Solicitudes de Prueba
        return [
            'person_id' => $this->faker->unique()->numberBetween(1, \App\Models\Person::count()), //Llave fóranea aleatoria uno a uno
            'status'    => $this->faker->randomElement(['requested', 'process', 'deliver']), //Estado aleatorio
        ];
    }
}
