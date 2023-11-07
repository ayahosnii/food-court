<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalWeightToRawMaterialInventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('raw_material_inventory', function (Blueprint $table) {
            $table->decimal('total_weight', 10, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::table('raw_material_inventory', function (Blueprint $table) {
            $table->dropColumn('total_weight');
        });
    }
};
