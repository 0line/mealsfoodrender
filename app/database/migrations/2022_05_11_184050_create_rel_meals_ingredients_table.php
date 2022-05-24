<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_meals_ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_meal_id');
            $table->unsignedBigInteger('fk_ingredient_id');
            $table->foreign('fk_meal_id')->references('id')->on('meals');
            $table->foreign('fk_ingredient_id')->references('id')->on('ingredients');
            $table->integer('qty_ingredient');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_meals_ingredients');
    }
};
