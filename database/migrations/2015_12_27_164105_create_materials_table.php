<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials',function(Blueprint $table){
            $table->increments('id');
            $table->string('name',50);
            $table->string('name_ru');
        });

        Schema::create('material_product',function(Blueprint $table){
            $table->integer('product_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->primary(['product_id','material_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('materials');
        Schema::drop('material_product');
    }
}
