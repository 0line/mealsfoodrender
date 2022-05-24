<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelMealsIngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Receta 1
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 1,
            'fk_ingredient_id' => 1,
            'qty_ingredient' => 1
        ]);

        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 1,
            'fk_ingredient_id' => 2,
            'qty_ingredient' => 1
        ]);

        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 1,
            'fk_ingredient_id' => 3,
            'qty_ingredient' => 1
        ]);

        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 1,
            'fk_ingredient_id' => 4,
            'qty_ingredient' => 1
        ]);

        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 1,
            'fk_ingredient_id' => 5,
            'qty_ingredient' => 1
        ]);
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 1,
            'fk_ingredient_id' => 6,
            'qty_ingredient' => 1
        ]);
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 1,
            'fk_ingredient_id' => 7,
            'qty_ingredient' => 1
        ]);
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 1,
            'fk_ingredient_id' => 8,
            'qty_ingredient' => 1
        ]);
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 1,
            'fk_ingredient_id' => 9,
            'qty_ingredient' => 1
        ]);
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 1,
            'fk_ingredient_id' => 10,
            'qty_ingredient' => 1
        ]);

        //Receta 2
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 2,
            'fk_ingredient_id' => 1,
            'qty_ingredient' => 2
        ]);

        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 2,
            'fk_ingredient_id' => 2,
            'qty_ingredient' => 1
        ]);

        //Receta 3
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 3,
            'fk_ingredient_id' => 6,
            'qty_ingredient' => 2
        ]);

        //Receta 4
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 4,
            'fk_ingredient_id' => 1,
            'qty_ingredient' => 2
        ]);
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 4,
            'fk_ingredient_id' => 5,
            'qty_ingredient' => 1
        ]);
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 4,
            'fk_ingredient_id' => 3,
            'qty_ingredient' => 1
        ]);

        //Receta 5
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 5,
            'fk_ingredient_id' => 7,
            'qty_ingredient' => 2
        ]);
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 5,
            'fk_ingredient_id' => 2,
            'qty_ingredient' => 1
        ]);
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 5,
            'fk_ingredient_id' => 3,
            'qty_ingredient' => 1
        ]);
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 5,
            'fk_ingredient_id' => 4,
            'qty_ingredient' => 3
        ]);
        //Receta 5
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 6,
            'fk_ingredient_id' => 1,
            'qty_ingredient' => 2
        ]);
        DB::table('rel_meals_ingredients')->insert([
            'fk_meal_id' => 6,
            'fk_ingredient_id' => 8,
            'qty_ingredient' => 4
        ]);
    }
}
