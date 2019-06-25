<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_counts', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('storage_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned();
            $table->float('quantity');
            $table->timestamps();
            $table->foreign('storage_id')->references('id')->on('storages')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_counts');
    }
}
