<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__warehouses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('department_id')->unsigned()->nullable();
            $table->string('sap_id')->nullable();//or any system
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('department_only')->nullable()->defaul(0);//visible status 0 => Show for all , 1 => Only department member
            $table->string('slug');//Friendly url
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
        Schema::dropIfExists('warehouse__warehouses');
    }
}
