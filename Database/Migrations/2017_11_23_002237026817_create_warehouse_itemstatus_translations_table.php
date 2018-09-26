<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseItemStatusTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__itemstatus_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('itemstatus_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['itemstatus_id', 'locale']);
            $table->foreign('itemstatus_id')->references('id')->on('warehouse__itemstatuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse__itemstatus_translations', function (Blueprint $table) {
            $table->dropForeign(['itemstatus_id']);
        });
        Schema::dropIfExists('warehouse__itemstatus_translations');
    }
}
