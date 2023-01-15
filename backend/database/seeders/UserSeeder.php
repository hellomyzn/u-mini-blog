<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'name' => 'hoge',
            'email' => 'hoge@hoge.com',
        ]);

        User::factory(1)->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
        ]);
    }
}
