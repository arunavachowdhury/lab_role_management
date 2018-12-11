<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->string('customer_name');
            $table->integer('sample_id')->unsigned();
            $table->string('sample_name');
            $table->date('sample_received_on');
            $table->date('date_of_disposal')->nullable();
            $table->string('sample_reference_no');
            $table->string('price')->nullable();
            $table->string('payment_details')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('tests');
    }
}
