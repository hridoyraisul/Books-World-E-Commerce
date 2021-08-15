<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_people', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('dob');
            $table->string('gender');
            $table->string('driving_license')->nullable();
            $table->string('address')->nullable();
            $table->integer('completed_delivery')->nullable();
            $table->string('status')->default('pending');
            $table->string('dp')->nullable();
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
        Schema::dropIfExists('delivery_people');
    }
}
