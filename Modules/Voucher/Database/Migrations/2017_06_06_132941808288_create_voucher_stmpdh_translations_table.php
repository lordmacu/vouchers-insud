<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherStmpdhTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher__stmpdh_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('stmpdh_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['stmpdh_id', 'locale']);
            $table->foreign('stmpdh_id')->references('id')->on('voucher__stmpdhs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voucher__stmpdh_translations', function (Blueprint $table) {
            $table->dropForeign(['stmpdh_id']);
        });
        Schema::dropIfExists('voucher__stmpdh_translations');
    }
}
