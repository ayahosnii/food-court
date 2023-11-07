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
        Schema::table('raw_materials', function (Blueprint $table) {
            $table->enum('unit', ['grams', 'kilograms', 'ounces', 'pounds', 'milligrams', 'micrograms']);
        });
    }

    public function down()
    {
        Schema::table('raw_materials', function (Blueprint $table) {
            $table->enum('unit', ['grams', 'kilograms', 'ounces', 'pounds', 'milligrams', 'micrograms']);
        });
    }

};
