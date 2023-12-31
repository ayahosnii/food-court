<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meal_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->longText('description');

            $table->unique(['meal_id', 'locale']);
            $table->foreign('meal_id')->references('id')->on('products')->onDelete('cascade');
        });
        DB::statement('ALTER TABLE product_translations ADD FULLTEXT(name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_translations');
    }
}
