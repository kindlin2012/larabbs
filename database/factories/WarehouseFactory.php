<?php

namespace Database\Factories;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    public function definition()
    {
        return [
            // $this->faker->name,
            // 'housename' => $this->faker->unique()->name,
            'housename' =>'house_'.Str::random(10),
            'user_id'=> $this->faker->randomElement([1,2,3,4]),
            'description' => $this->faker->text(),


        ];
    }
}
