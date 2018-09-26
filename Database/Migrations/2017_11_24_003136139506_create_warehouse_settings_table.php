<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('warehouse_id')->unsigned();
            $table->text('disiabled_fileds')->nullable();
            $table->text('issuecard_disabled_fields')->nullable();
            $table->text('item_guest_disabled_fields')->nullable();
            $table->text('issuecard_guest_disabled_fields')->nullable();
            $table->text('issue_card_sap_export')->nullable();
            $table->string('barcode_ip')->nullable();
            $table->text('top_barcode_fields')->nullable();
            $table->text('bottom_barcode_fields')->nullable();
            $table->string('item_required_field')->nullable();
            $table->boolean('item_footer_search')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse__settings');
    }
}
