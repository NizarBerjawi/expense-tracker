<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('tag_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('categories', function(Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags');
        });

        Schema::table('categories', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('income');
        Schema::dropIfExists('categories');
    }
}
