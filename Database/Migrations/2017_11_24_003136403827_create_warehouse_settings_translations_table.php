<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseSettingsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__settings_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('settings_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['settings_id', 'locale']);
            $table->foreign('settings_id')->references('id')->on('warehouse__settings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse__settings_translations', function (Blueprint $table) {
            $table->dropForeign(['settings_id']);
        });
        Schema::dropIfExists('warehouse__settings_translations');
    }
}
