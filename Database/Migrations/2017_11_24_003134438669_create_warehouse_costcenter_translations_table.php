<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseCostCenterTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__costcenter_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');

            $table->integer('cost_center_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['cost_center_id', 'locale']);
            $table->foreign('cost_center_id')->references('id')->on('warehouse__costcenters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse__costcenter_translations', function (Blueprint $table) {
            $table->dropForeign(['cost_center_id']);
        });
        Schema::dropIfExists('warehouse__costcenter_translations');
    }
}
