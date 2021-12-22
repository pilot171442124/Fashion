<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddedcartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addedcart', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('addtocart_id');
            $table->string('product_id');
            $table->string('product_name')->nullable();
            $table->string('product_price')->nullable();
            $table->string('image')->nullable();
            $table->string('discount')->nullable();
            $table->string('size')->nullable();
            $table->string('tags')->nullable();
        
            $table->string('quantity')->nullable();
            $table->string('cartcode');
            $table->string('cupon_status')->nullable();
            $table->string('payment_status')->nullable();

            $table->string('total')->nullable();

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
        Schema::dropIfExists('addedcart');
    }
}
