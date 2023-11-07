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
            // Add a unique constraint for the combination of meal_id and raw_material_id
            $table->unique(['meal_id', 'raw_material_id']);
        });
    }

    public function down()
    {
        Schema::table('meal_raw_material', function (Blueprint $table) {
            // Remove the unique constraint if needed
            $table->dropUnique(['meal_id', 'raw_material_id']);
        });
    }
};
