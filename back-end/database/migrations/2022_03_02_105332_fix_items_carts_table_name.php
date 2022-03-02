<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('items_carts', 'item_carts');
    }

    public function down()
    {
        Schema::rename('item_carts', 'items_carts');
    }
};
