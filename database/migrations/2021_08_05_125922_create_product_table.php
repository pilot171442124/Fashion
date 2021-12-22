<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_cat_id')->length(20)->unsigned();

            $table->float('price')->default(0);
            //$table->string('quantities');
            $table->string('tags');
           // $table->string('size')->nullable();
            $table->float('discount')->default(0)->nullable();
            $table->string('promo_code')->nullable();
            $table->string('stok');
            $table->string('product_gen')->nullable();

            $table->string('imageurl')->nullable();
            $table->string('Remarks',350)->nullable();
            $table->timestamps();
            $table->foreign('product_cat_id')->references('id')->on('product_category');
           
       
        });
    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
