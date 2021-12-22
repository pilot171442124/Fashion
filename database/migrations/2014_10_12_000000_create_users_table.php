<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('userrole');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('gender')->nullable();

            $table->string('usercode');
            $table->string('activestatus')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    
    
    

        $Password = Hash::make('12345678');
        DB::table('users')->insert([
            ['usercode' => 'R667788R','name'=>'Alamgir','email' => 'Alamgir@gmail.com','userrole' => 'Admin','gender' => 'male','activestatus' => 'Active','phone' => '01871008902','password' => $Password]
        ]);
    
    
    
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
