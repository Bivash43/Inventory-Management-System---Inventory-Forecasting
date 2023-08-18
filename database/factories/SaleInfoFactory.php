<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleInfo>
 */
class SaleInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 10),
            'category_id' => $this->faker->numberBetween(1, 5),
            'quantity' => $this->faker->numberBetween(29000, 35000),
            'sold_date' => $this->faker->dateTimeBetween('2022-01-01', '2022-12-31')->format('Y-m-d'),
        ];
    }
}
