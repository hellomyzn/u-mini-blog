<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;

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

        User::factory(10)->create()->each(function ($user){
            Blog::factory(random_int(2,5))->create(['user_id' => $user->id])->each(function ($blog){
                Comment::factory(random_int(0, 3))->create(['blog_id' => $blog->id]);
            });
        });
    }
}
