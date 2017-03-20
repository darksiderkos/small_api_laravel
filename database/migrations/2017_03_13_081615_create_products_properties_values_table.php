<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsPropertiesValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_properties_values', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->UnsignedInteger('product_id');
            $table->UnsignedInteger('property_id');
            $table->UnsignedInteger('value_id');


            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');

            $table->foreign('property_id')
                ->references('id')->on('properties')
                ->onDelete('cascade');

            $table->foreign('value_id')
                ->references('id')->on('values')
                ->onDelete('cascade');

//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_properties_values');
    }
}
