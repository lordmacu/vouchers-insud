<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherCgmsbcTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher__cgmsbc_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('CGMSBC_CODDIM');
            $table->string('CGMSBC_SUBCUE');
            $table->string('CGMSBC_DESCRP');

            $table->integer('cgmsbc_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['cgmsbc_id', 'locale']);
            $table->foreign('cgmsbc_id')->references('id')->on('voucher__cgmsbcs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voucher__cgmsbc_translations', function (Blueprint $table) {
            $table->dropForeign(['cgmsbc_id']);
        });
        Schema::dropIfExists('voucher__cgmsbc_translations');
    }
}
