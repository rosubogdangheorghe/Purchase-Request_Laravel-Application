<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasebodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasebodies', function (Blueprint $table) {
             	        $table->id();
                        $table->integer('purchaseheaders_id');
                        $table->string('description');
                        $table->enum('unitMeasure',['kg','pcs','batch']);
                        $table->decimal('quantity',8,2);
                        $table->decimal('unitPrice',8,2);
                        $table->decimal('prvalue',8,2);
                        $table->enum('budgeted',['yes','no']);
                        $table->string('budgetLine');   
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
        Schema::dropIfExists('purchasebodies');
    }
}
