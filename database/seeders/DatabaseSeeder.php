<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Like;
use App\Models\Question;
use App\Models\Reply;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Eloquent\Factories\Factory as FactoriesFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Category::factory(5)->create();
        Question::factory(10)->create();
        Reply::factory(50)->create()->each(function($reply){
            return $reply->like()->save(Like::factory()->make());
        });
    }
}
