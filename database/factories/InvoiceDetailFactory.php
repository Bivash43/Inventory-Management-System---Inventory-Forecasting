<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceDetail>
 */
class InvoiceDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('2022-01-01', '2022-12-31')->format('Y-m-d'),
            'invoice_id' => $this->faker->numberBetween(1, 10),
            'product_id' => $this->faker->numberBetween(1, 10),
            'category_id' => $this->faker->numberBetween(1, 5),
            'selling_qty' => $this->faker->numberBetween(29000, 35000),
            'unit_price' => $this->faker->numberBetween(20, 35),
            'selling_price' => $this->faker->numberBetween(29000, 35000),
            'status' => $this->faker->numberBetween(0, 1),
        ];
    }
}
