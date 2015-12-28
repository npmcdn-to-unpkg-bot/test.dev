<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories',function(Blueprint $table){

            $table->increments('id');
            $table->string('name',30);
            $table->string('name_ru',30);
            $table->softDeletes();
            NestedSet::columns($table);

        });

        Schema::create('category_product',function(Blueprint $table){

            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['product_id','category_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
        Schema::drop('category_product');
    }
}
