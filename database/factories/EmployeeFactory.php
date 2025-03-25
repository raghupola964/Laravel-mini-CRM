<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;
use App\Models\Company;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_id' => Company::inRandomOrder()->first()->id ?? Company::factory(),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}