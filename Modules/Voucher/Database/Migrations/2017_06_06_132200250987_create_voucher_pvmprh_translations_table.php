<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherPvmprhTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher__pvmprh_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('pvmprh_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['pvmprh_id', 'locale']);
            $table->foreign('pvmprh_id')->references('id')->on('voucher__pvmprhs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voucher__pvmprh_translations', function (Blueprint $table) {
            $table->dropForeign(['pvmprh_id']);
        });
        Schema::dropIfExists('voucher__pvmprh_translations');
    }
}
