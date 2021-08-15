<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('title');
            $table->string('description');
            $table->string('picture')->nullable();
            $table->string('picture_caption')->nullable();
            $table->json('tag')->nullable();
            $table->string('status')->default('active');
            $table->integer('reaction')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->integer('price')->nullable();
            $table->integer('quantity')->nullable();
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
        Schema::dropIfExists('books');
    }
}
