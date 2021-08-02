<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bd_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country_code');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('present_address');
            $table->string('permanent_address');
            $table->string('mobile_number')->nullable();
            //---------add--balance
            $table->double('drop_balance')->nullable();
          
            $table->double('affiliate_balance')->nullable();
            //---------add--balance
            $table->string('add_money_balance')->nullable();
            $table->string('balance')->nullable(); 
            $table->string('total_earn')->nullable(); 
            $table->double('product_balance')->nullable(); 
            $table->string('cover_image')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('mac_id')->nullable();
            $table->text('token')->nullable(); 
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('bd_users');
    }
}