<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseIssueCardTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__issuecard_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('local_name');
            // Your translatable fields

            $table->integer('issue_card_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['issue_card_id', 'locale']);
            $table->foreign('issue_card_id')->references('id')->on('warehouse__issuecards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse__issuecard_translations', function (Blueprint $table) {
            $table->dropForeign(['issue_card_id']);
        });
        Schema::dropIfExists('warehouse__issuecard_translations');
    }
}
