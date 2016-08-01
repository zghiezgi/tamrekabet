<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmalarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firmalar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('adi', 255);
            $table->string('logo');
            $table->text('tanitim_yazisi');
            $table->date('kurulus_tarihi');
            $table->string('bilgilendirme_tercihi');
            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('firmalar');
    }
}
