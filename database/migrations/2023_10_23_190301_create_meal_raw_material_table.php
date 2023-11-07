<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealRawMaterialTable extends Migration
{
    public function up()
    {
        Schema::create('meal_raw_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('meal_id');
            $table->unsignedBigInteger('raw_material_id');
            $table->decimal('quantity', 10, 2);
            $table->timestamps();


            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->foreign('raw_material_id')->references('id')->on('raw_materials')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_raw_material');
    }
}
