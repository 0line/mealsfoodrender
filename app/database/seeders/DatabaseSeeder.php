<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\IngredientsSeeder;
use Database\Seeders\FoodsSeeder;
use Database\Seeders\RelMealsIngredientsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->call(IngredientsSeeder::class);
        $this->call(FoodsSeeder::class);
        $this->call(RelMealsIngredientsSeeder::class);
    }
}
