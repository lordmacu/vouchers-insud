<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherGrcforTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher__grcfor_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
             $table->string('GRCFOR_MODFOR');
            $table->string('GRCFOR_CODFOR');
            $table->string('GRCFOR_DESCRP');

            $table->integer('grcfor_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['grcfor_id', 'locale']);
            $table->foreign('grcfor_id')->references('id')->on('voucher__grcfors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voucher__grcfor_translations', function (Blueprint $table) {
            $table->dropForeign(['grcfor_id']);
        });
        Schema::dropIfExists('voucher__grcfor_translations');
    }
}
