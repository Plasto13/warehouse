<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('warehouse_id')->unsigned()->nullable();
            $table->string('material_number')->unique();//SAP number
            $table->text('name')->nullable();
            $table->text('local_name')->nullable();
            $table->float('quantity',7,2)->default(0)->nullable();
            $table->float('minimum',7,2)->default(1)->nullable();
            $table->float('maximum',7,2)->nullable();
            $table->text('specification')->nullable();
            $table->text('order_number')->nullable();
            $table->float('price',7,2)->nullable();
            $table->string('storage_position')->nullable();
            $table->string('manufacture')->nullable();
            $table->string('supplier')->nullable();
            $table->text('suppliers')->nullable();
            $table->string('documentation_number')->nullable();
            $table->text('remarks')->nullable();
            $table->string('photo')->nullable();
            $table->text('url')->nullable();
            $table->string('slug')->default('');//Friendly url
            $table->string('cost_center')->nullable();
            $table->string('equipment')->nullable();
            $table->boolean('published')->default(true);
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
        Schema::dropIfExists('warehouse__items');
    }
}
