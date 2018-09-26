<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseIssueCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__issuecards', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('warehouse_id')->unsigned()->nullable();
            $table->integer('item_id')->unsigned()->nullable();
            $table->integer('costcenter_id')->unsigned()->nullable();
            $table->integer('machinepart_id')->unsigned()->nullable();
            $table->string('material_number');//SAP number
            $table->text('name')->nullable();
            $table->integer('minimum')->nullable();
            $table->integer('maximum')->nullable();
            $table->text('local_name')->nullable();
            $table->text('user_full_name');
            $table->float('issuing_volume',7,2);// Vydane mnozstvo
            $table->float('quantity',7,2)->nullable();
            $table->text('specification')->nullable();
            $table->text('order_number')->nullable();
            $table->float('price',7,2)->nullable();
            $table->string('storage_position')->nullable();
            $table->string('manufacture')->nullable();
            $table->string('supplier')->nullable();
            $table->text('suppliers')->nullable();
            $table->string('documentation_number')->nullable();
            $table->text('url')->nullable();
            $table->string('slug')->default('');//Friendly url
            $table->string('equipment')->nullable();
            $table->boolean('exported')->default(false);
            $table->text('reason')->nullable();
            $table->text('remark')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('warehouse_id')->references('id')->on('warehouse__warehouses')->onDelete('cascade'); 
            $table->foreign('item_id')->references('id')->on('warehouse__items')->onDelete('SET NULL'); 
            $table->foreign('costcenter_id')->references('id')->on('warehouse__costcenters')->onDelete('NO ACTION'); 
            $table->foreign('machinepart_id')->references('id')->on('warehouse__machineparts')->onDelete('NO ACTION'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse__issuecards');
    }
}
