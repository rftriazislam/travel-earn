<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country_code');
            $table->integer('delivery_id');
            $table->integer('c_id');
            $table->integer('c_sponsor_id');
            $table->double('c_sponsor_commission');
            $table->integer('t_id');
            $table->integer('t_sponsor_id');
            $table->double('t_sponsor_commission');
            $table->string('pyment_type');
            $table->double('commission_price');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('company_balances');
    }
}