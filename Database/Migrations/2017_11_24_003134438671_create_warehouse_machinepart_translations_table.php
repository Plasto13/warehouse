<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseMachinePartTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__machinepart_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');

            $table->integer('machine_part_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['machine_part_id', 'locale'],'warehouse__machinepart_translations');
            $table->foreign('machine_part_id')->references('id')->on('warehouse__machineparts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse__machinepart_translations', function (Blueprint $table) {
            $table->dropForeign(['machine_part_id']);
        });
        Schema::dropIfExists('warehouse__machinepart_translations');
    }
}
