<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('shoplist_id')->unsigned();
            $table->foreign('shoplist_id')->references('id')->on('shoplists')->onDelete('cascade');
            $table->string('product_name');
            $table->string('product_url');
            $table->char('size', 5);
            $table->string('color');
            $table->smallInteger('quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     *
     *
     *
     */


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
