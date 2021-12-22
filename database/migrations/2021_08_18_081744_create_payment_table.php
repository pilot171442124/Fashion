<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();


            $table->integer('user_id')->nullable();
            $table->string('addedcart_id');         
            $table->string('product_name')->nullable();
            $table->string('payment_txr')->nullable();
            $table->string('amount')->nullable();
            $table->string('merchantInvoice')->nullable();
            $table->string('address_code')->nullable();
            $table->string('product_size')->nullable();
            
            $table->string('discount')->nullable();
  
            $table->string('quantity')->nullable();
       
            $table->string('status')->nullable();
        
           
           
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
        Schema::dropIfExists('payment');
    }
}
