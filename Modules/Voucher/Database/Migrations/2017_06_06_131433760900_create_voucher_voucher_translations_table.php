<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherVoucherTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher__voucher_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('voucher_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['voucher_id', 'locale']);
            $table->foreign('voucher_id')->references('id')->on('voucher__vouchers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voucher__voucher_translations', function (Blueprint $table) {
            $table->dropForeign(['voucher_id']);
        });
        Schema::dropIfExists('voucher__voucher_translations');
    }
}
