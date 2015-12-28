<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons',function(Blueprint $table){

            $table->increments('id');
            $table->string('name');
            $table->string('slug');

        });

        Schema::create('product_season',function(Blueprint $table){

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('season_id')->unsigned()->index();
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seasons');
        Schema::drop('product_season');
    }
}
