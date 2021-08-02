<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndRequestServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ind_request_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('traveller_id');
            $table->integer('ind_services_id');
            $table->string('country_code');
            $table->double('weight');
            $table->string('product_type');
            $table->string('product_name');
            $table->double('product_buy_price')->nullable();
            $table->string('product_description')->nullable();
            $table->double('delivery_cost');
            $table->double('pyment_type');
            $table->boolean('active_status')->default(0);
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
        Schema::dropIfExists('ind_request_services');
    }
}