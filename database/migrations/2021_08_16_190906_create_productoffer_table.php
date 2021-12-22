<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductofferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productoffer', function (Blueprint $table) {
            $table->id();
            $table->string('offername');          
            $table->string('promo_code');
            $table->string('discount')->nullable();
            $table->string('min_price')->nullable();
            $table->string('product_name')->nullable();
            $table->string('srt_date')->nullable();
            $table->string('last_date')->nullable();
            $table->string('qt')->nullable();

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
        Schema::dropIfExists('productoffer');
    }
}
