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
        Schema::table('meals', function (Blueprint $table) {
            // Add the new column
            $table->unsignedInteger('arabic_main_category_id')->nullable();

            // Define the foreign key constraint
            $table->foreign('arabic_main_category_id')
                ->references('id')
                ->on('main_categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->dropForeign(['arabic_main_category_id']);

            $table->dropColumn('arabic_main_category_id');

        });
    }
};
