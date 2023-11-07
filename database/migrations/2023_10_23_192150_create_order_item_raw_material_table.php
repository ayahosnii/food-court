<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateOrderItemRawMaterialTable extends Migration
{
    public function up()
    {
        Schema::create('order_item_raw_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_item_id');
            $table->unsignedBigInteger('raw_material_id');
            $table->decimal('before_quantity', 10, 2);
            $table->decimal('after_quantity', 10, 2);
            $table->timestamps();

            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
            $table->foreign('raw_material_id')->references('id')->on('raw_materials')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_item_raw_material');
    }
}
