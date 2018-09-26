<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseWarehouseTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__warehouse_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();

            $table->integer('warehouse_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['warehouse_id', 'locale']);
            $table->foreign('warehouse_id')->references('id')->on('warehouse__warehouses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse__warehouse_translations', function (Blueprint $table) {
            $table->dropForeign(['warehouse_id']);
        });
        Schema::dropIfExists('warehouse__warehouse_translations');
    }
}
