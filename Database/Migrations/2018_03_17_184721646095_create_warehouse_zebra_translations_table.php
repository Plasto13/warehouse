<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseZebraTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__zebra_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('zebra_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['zebra_id', 'locale']);
            $table->foreign('zebra_id')->references('id')->on('warehouse__zebras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse__zebra_translations', function (Blueprint $table) {
            $table->dropForeign(['zebra_id']);
        });
        Schema::dropIfExists('warehouse__zebra_translations');
    }
}
