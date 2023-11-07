<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateOrderStatusColumn extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE orders MODIFY status ENUM('ordered', 'delivered', 'canceled', 'cooked') NOT NULL DEFAULT 'ordered'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE orders MODIFY status ENUM('ordered', 'delivered', 'canceled', 'cooked') NOT NULL DEFAULT 'ordered'");

    }
};
