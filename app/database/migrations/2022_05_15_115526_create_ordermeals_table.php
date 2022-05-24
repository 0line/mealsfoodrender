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
        Schema::create('ordermeals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_order');
            $table->unsignedBigInteger('fk_meal_id');
            $table->foreign('fk_order')->references('id')->on('orders');
            $table->foreign('fk_meal_id')->references('id')->on('meals');
            $table->integer('qty');
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
        Schema::dropIfExists('ordermeals');
    }
};
