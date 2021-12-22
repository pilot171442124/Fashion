<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddtocartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addtocart', function (Blueprint $table) {
            $table->id();


            $table->bigInteger('product_id')->length(20)->unsigned();
            $table->string('client_ip')->nullable();
            $table->float('cart_price')->default(0);
            $table->float('product_price')->default(0);
            $table->float('product_discount')->nullable()->default(0);

            $table->string('temp_userid');
            $table->string('customer_id')->nullable(); 
            $table->string('quantity');
            $table->string('products_size')->nullable(); 

            $table->string('update_disc_status')->nullable();
            $table->string('update_price_status')->nullable();
            $table->string('cupon_status')->nullable();
            $table->string('payment_status')->nullable();

            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('product');

          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addtocart');
    }
}
