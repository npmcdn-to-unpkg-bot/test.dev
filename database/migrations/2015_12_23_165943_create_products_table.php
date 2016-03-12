<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateProductsTable extends Migration
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

        Schema::create('products',function(Blueprint $table){
            $table->increments('id');
            $table->string('model',15)->unique();
            $table->string('article',15)->nullable();
            $table->integer('category_id')->unsigned();
            $table->string('growth')->nullable();
            $table->string('size')->nullable();
            $table->text('description')->nullable();
            $table->boolean('new')->default(0);
            $table->boolean('published')->default(0);
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->uonUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
    }
}
