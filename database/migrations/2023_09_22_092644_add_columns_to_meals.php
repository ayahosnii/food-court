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
            $table->boolean('manage_stock');
            $table->boolean('in_stock');
            $table->unsignedInteger('viewed')->default(0);
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->dropColumn('manage_stock');
            $table->dropColumn('in_stock');
            $table->dropColumn('viewed');
            $table->dropSoftDeletes();
        });
    }
};
