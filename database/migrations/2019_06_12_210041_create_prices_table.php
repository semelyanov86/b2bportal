<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->bigInteger('pricelist_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->decimal('price')->nullable();
            $table->string('currency');
            $table->timestamps();
            $table->unique(['id', 'pricelist_id']);
            $table->primary(['id', 'pricelist_id', 'product_id']);
        });
        Schema::table('prices', function($table) {
            $table->foreign('pricelist_id')->references('id')->on('pricelists')->onDelete('cascade');
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
        Schema::dropIfExists('prices');
    }
}
