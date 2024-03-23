<?php

namespace Database\Factories;

use App\Models\Notebook;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notebook>
 */
class NotebookFactory extends Factory
{
    protected $model = Notebook::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lastName'    => $this->faker->lastName,
            'firstName'   => $this->faker->firstName,
            'fatherName'  => $this->faker->firstNameMale,
            'companyName' => $this->faker->company,
            'phone'        => $this->faker->phoneNumber,
            'email'        => $this->faker->unique()->safeEmail,
            'birth_date'   => $this->faker->date,
            'image_id'     => null,
        ];
    }
}
