<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseCostCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__costcenters', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('warehouse_id')->unsigned();
            $table->string('title');
            $table->string('code');
            $table->text('extra')->nullable();
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('warehouse__costcenters');
    }
}
