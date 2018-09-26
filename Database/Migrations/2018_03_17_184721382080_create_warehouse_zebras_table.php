<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseZebrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__zebras', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('warehouse_id')->unsigned();
            $table->string('title');
            $table->string('description')->nullable();
            $table->ipAddress('ip');
            $table->string('label_size_x')->nullable();
            $table->string('label_size_y')->nullable();
            $table->string('print_density')->nullable();
            $table->string('top_row')->nullable();
            $table->string('second_row')->nullable();
            $table->string('third_row')->nullable();
            $table->string('code_row');
            $table->text('extra')->nullable();
            $table->boolean('default')->nullable();
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
        Schema::dropIfExists('warehouse__zebras');
    }
}
