<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherRendicionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher__rendicion_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('rendicion_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['rendicion_id', 'locale']);
            $table->foreign('rendicion_id')->references('id')->on('voucher__rendicions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voucher__rendicion_translations', function (Blueprint $table) {
            $table->dropForeign(['rendicion_id']);
        });
        Schema::dropIfExists('voucher__rendicion_translations');
    }
}
