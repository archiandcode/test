<?php

namespace Database\Factories;

use App\Models\Knife;
use App\Models\KnifeType;
use Illuminate\Database\Eloquent\Factories\Factory;

class KnifeFactory extends Factory
{
    protected $model = Knife::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word . ' Knife',
            'image' => null,
            'knife_type_id' => KnifeType::inRandomOrder()->value('id'),
        ];
    }
}
