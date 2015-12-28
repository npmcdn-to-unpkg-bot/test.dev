<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products',function(Blueprint $table){
            $table->increments('id');
            $table->string('model',15);
            $table->string('article',15)->nullable();
            $table->string('growth')->nullable();
            $table->string('size')->nullable();
            $table->text('description')->nullable();
            $table->boolean('new')->default(0);
            $table->boolean('published')->default(0);
            $table->string('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
