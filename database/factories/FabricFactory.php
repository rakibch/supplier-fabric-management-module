<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FabricFactory extends Factory
{
    protected $model = \App\Models\Fabric::class;

    public function definition()
    {
        return [
            'supplier_id' => null, // set in seeder
            'fabric_no' => strtoupper($this->faker->bothify('FAB-###??')),
            'composition' => $this->faker->randomElement(['100% Cotton','80/20','Polyester','Viscose']),
            'gsm' => $this->faker->numberBetween(80,400),
            'qty' => $this->faker->numberBetween(10,200),
            'cuttable_width' => $this->faker->randomElement(['42','58','60']),
            'production_type' => $this->faker->randomElement(['Sample Yardage','SMS','Bulk']),
            'added_by' => 1,
            'added_date' => now(),
        ];
    }
}
