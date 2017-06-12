<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('bank');
            $table->decimal('starting_balance', 12, 2)->default(0);
            $table->decimal('balance', 12, 2)->default(0);
            $table->timestamps();
        });

        Schema::table('bank_accounts', function(Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        Schema::table('expenses', function(Blueprint $table) {
            $table->foreign('bank_account_id')
                  ->references('id')
                  ->on('bank_accounts')
                  ->onDelete('cascade');
        });

        Schema::table('income', function(Blueprint $table) {
            $table->foreign('bank_account_id')
                  ->references('id')
                  ->on('bank_accounts')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('bank_accounts');
    }
}
