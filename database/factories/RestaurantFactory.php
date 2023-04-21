<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'brand' => fake()->randomElement(['饗食天堂', '果然慧', '饗饗', '旭集', '小福利', '朵頤', '開飯', '饗太多', '真珠']),
            'shop' => fake()->randomElement(['新光', '京站', '信義', '板橋', '高雄', '中壢', '夢時代', '台中', '台南', '台北']),
            'address' => fake()->address(),
            'location' => fake()->randomElement(['北部', '中部', '南部', '東部', '離島']),
        ];
    }
}
