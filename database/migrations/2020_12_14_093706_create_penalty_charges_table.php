<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenaltyChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penalty_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('service_request_id');
            $table->integer('user_id');
            $table->double('user_commission');
            $table->integer('traveller_id');
            $table->double('traveller_commission');
            $table->double('company_commission');
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
        Schema::dropIfExists('penalty_charges');
    }
}