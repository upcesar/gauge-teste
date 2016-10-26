<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('gender');
            $table->string('title');
            $table->string('full_name');            
            
            //Location
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('postcode');
           
            
            $table->string('email')->unique();
            
            //Login
            $table->string('username')->unique();
            $table->string('password');
            
            //Phone
            $table->string('phone');
            $table->string('cell');
            
            //Picture
            $table->string('picture_large');
            $table->string('picture_medium');
            $table->string('picture_thumbnail');
            
            $table->string('nat');
            
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
