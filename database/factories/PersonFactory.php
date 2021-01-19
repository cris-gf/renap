<?php

namespace Database\Factories;

use App\Models\person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //Personas de prueba, datos de USA
        return [
            'cui'                 => $this->faker->numerify('#############'),
            'identification_card' => $this->faker->numerify('############'),
            'name'                => $this->faker->firstName,
            'last_name'           => $this->faker->lastName,
            'birthdate'           => $this->faker->date($format = 'Y-m-d', $max = '-18 years'), //Mayor de edad
            'address'             => $this->faker->streetAddress,
            'phone'               => $this->faker->numerify('########'),
            'department'          => $this->faker->state,
            'township'            => $this->faker->city,
            'email'               => $this->faker->email,
            'picture'             => $this->faker->imageUrl($width = 113, $height = 142), //Tamaño cédula
            'password'            => $this->faker->password($min_length = 8, $max_length = 8),
        ];
    }
}
