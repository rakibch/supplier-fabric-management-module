<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SupplierFactory extends Factory
{
    protected $model = \App\Models\Supplier::class;

    public function definition()
    {
        $company = $this->faker->company;
        return [
            'country' => $this->faker->country,
            'company_name' => $company,
            'code' => Str::upper(Str::random(6)),
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'rep_name' => $this->faker->name,
            'rep_email' => $this->faker->safeEmail,
            'rep_phone' => $this->faker->phoneNumber,
            'added_by' => 1,
            'added_date' => now(),
        ];
    }
}
