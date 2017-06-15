<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquid_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->decimal('starting_balance', 12, 2)->default(0);
            $table->decimal('balance', 12, 2)->default(0);
            $table->timestamps();
        });

        Schema::table('liquid_assets', function(Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        Schema::table('expenses', function(Blueprint $table) {
            $table->foreign('liquid_asset_id')
                  ->references('id')
                  ->on('liquid_assets')
                  ->onDelete('set null');
        });

        Schema::table('income', function(Blueprint $table) {
            $table->foreign('liquid_asset_id')
                  ->references('id')
                  ->on('liquid_assets')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('liquid_assets');
    }
}
