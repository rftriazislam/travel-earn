<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdAgentVerifiedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bd_agent_verifieds', function (Blueprint $table) {

              $table->bigIncrements('id');
              $table->integer('agent_id');
              $table->integer('traveller_id');
              $table->string('agent_with_traveller_selfie');
              $table->string('document_pdf')->nullable();
              $table->boolean('status')->default(0);


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
        Schema::dropIfExists('bd_agent_verifieds');
    }
}