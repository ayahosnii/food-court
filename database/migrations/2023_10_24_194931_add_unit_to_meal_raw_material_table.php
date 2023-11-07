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
        Schema::table('meal_raw_material', function (Blueprint $table) {
            $table->enum('unit', ['grams', 'kilograms', 'ounces', 'pounds', 'milligrams', 'micrograms']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meal_raw_material', function (Blueprint $table) {
            $table->enum('unit', ['grams', 'kilograms', 'ounces', 'pounds', 'milligrams', 'micrograms']);
        });
    }
};
