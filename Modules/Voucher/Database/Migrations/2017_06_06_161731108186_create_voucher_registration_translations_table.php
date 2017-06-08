<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherRegistrationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher__registration_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields


            $table->string('REGIST_ID');
            $table->string('REGIST_USERIID');
            $table->date('REGIST_FECALT');
            $table->time('REGIST_TIMALT');
            $table->string('REGIST_USERUID');
            $table->date('REGIST_FECMOD');
            $table->time('REGIST_TIMMOD');
            $table->string('REGIST_TRANSF');
            $table->string('REGIST_CABITM');
            $table->integer('REGIST_NROITM');
            $table->string('PVMPRH_NROCTA');
            $table->date('REGIST_FECMOV');
            $table->string('GRCFOR_MODFOR');
            $table->string('GRCFOR_CODFOR');
            $table->string('CGMSBC_CODDIM');
            $table->string('CGMSBC_SUBCUE');
            $table->string('STMPDH_TIPPRO');
            $table->string('STMPDH_ARTCOD');
            $table->float('REGIST_CANTID');
            $table->float('REGIST_IMPORT');
            $table->float('REGIST_IMPIVA');


            $table->integer('registration_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['registration_id', 'locale']);
            $table->foreign('registration_id')->references('id')->on('voucher__registrations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voucher__registration_translations', function (Blueprint $table) {
            $table->dropForeign(['registration_id']);
        });
        Schema::dropIfExists('voucher__registration_translations');
    }
}
