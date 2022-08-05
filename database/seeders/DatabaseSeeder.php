<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $device = Device::factory()->count(1)->create([
            'public_key' => "1",
            'private_key' =>  Hash::make("1")
        ]);

        Device::factory()->count(3)->create();
    }
}
