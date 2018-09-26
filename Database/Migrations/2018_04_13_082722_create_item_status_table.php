<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses__item_itemstatuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('item_status_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('item_id')->references('id')->on('warehouse__items')->onDelete('cascade'); 
            $table->foreign('item_status_id')->references('id')->on('warehouse__itemstatuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouses__item_itemstatuses');
    }
}
