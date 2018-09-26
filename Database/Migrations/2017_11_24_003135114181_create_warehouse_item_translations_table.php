<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseItemTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__item_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('local_name')->nullable();
            $table->text('remarks')->nullable();

            $table->integer('item_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['item_id', 'locale']);
            $table->foreign('item_id')->references('id')->on('warehouse__items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse__item_translations', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
        });
        Schema::dropIfExists('warehouse__item_translations');
    }
}
