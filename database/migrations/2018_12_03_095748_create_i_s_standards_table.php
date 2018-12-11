<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateISStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_s_standards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->integer('sample_id')->unsigned();
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('i_s_standards');
    }
}
