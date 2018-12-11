<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Helper\Table;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id')->unsigned();
            $table->integer('test_item_id')->unsigned();
            $table->string('test_item_name');
            $table->integer('lab_id')->nullable()->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('ref_lab_id')->nullable()->unsigned();
            $table->integer('ref_user_id')->nullable()->unsigned();
            $table->integer('modified_by')->nullable()->unsigned();
            $table->string('price')->nullable();
            $table->string('specified_range_from');
            $table->string('specified_range_to');
            $table->float('observed_value')->nullable();
            $table->string('is_new');
            $table->string('in_range')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('test_id')->references('id')->on('tests');
            $table->foreign('test_item_id')->references('id')->on('test_items');
            $table->foreign('lab_id')->references('id')->on('labs');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ref_lab_id')->references('id')->on('labs');
            $table->foreign('ref_user_id')->references('id')->on('users');
            $table->foreign('modified_by')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
