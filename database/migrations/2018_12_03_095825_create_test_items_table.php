<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('sample_id')->unsigned();
            $table->integer('isstandard_id')->unsigned();
            $table->integer('uom_id')->unsigned();
            $table->string('specified_range_from');
            $table->string('specified_range_to');
            $table->text('description');
            $table->string('price')->nullable();
            $table->string('is_new')->default(0);
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples');
            $table->foreign('uom_id')->references('id')->on('uoms');
            $table->foreign('isstandard_id')->references('id')->on('i_s_standards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_items');
    }
}
