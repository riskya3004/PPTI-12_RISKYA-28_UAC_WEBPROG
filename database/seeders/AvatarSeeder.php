<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    public function run()
    {
        $avatars = [
            ['name' => 'avatar1.png', 'price' => 50],
            ['name' => 'avatar2.png', 'price' => 75],
            ['name' => 'avatar3.png', 'price' => 100],
            // Add more avatar data here
        ];

        foreach ($avatars as $avatar) {
            Avatar::create($avatar);
        }
    }
}
