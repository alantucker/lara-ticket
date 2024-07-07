<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Technical Issue',
                'Billing and Payments',
                'Product Inquiries',
                'Complaints and Feedback',
                'Account Management',
                'Feature Request',
                'How To',
            ]),
        ];
    }
}
