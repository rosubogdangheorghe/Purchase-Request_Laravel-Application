<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseheadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseheaders', function (Blueprint $table) {

                        $table->id();
                        $table->date('issueDate');
                        $table->date('deliveryDate');
                        $table->integer('costcenters_id');
                        $table->integer('suppliers_id');
                        $table->integer('users_id');
                        $table->enum('currency',['ron','euro','usd','jpy','gbp']);
                        $table->decimal('fxRate',4,4);
                        $table->enum('status',['progress','issued','checked','approved','rejected','received']);
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
        Schema::dropIfExists('purchaseheaders');
    }
}
