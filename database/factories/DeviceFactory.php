<?php

namespace Database\Factories;

use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class DeviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Device::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->iso8601,
            'extra_data' => [
                'light' => $this->faker->randomElement(['on', 'off']),
                'temprature' => rand(10, 100000),
                'bpm' => rand(10, 100000)
            ],
            'public_key' => "pk_" . rand(999, 9999999999),
            'private_key' => Hash::make('password')
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Device $device) {
            //
        })->afterCreating(function (Device $device) {
            $device->createToken($device->name);
        });
    }
}
