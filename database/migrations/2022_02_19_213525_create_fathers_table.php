<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFathersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fathers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name', 30);
            $table->boolean('confirmed')->default(false);
            $table->string('mobileNumber', 15);
            $table->integer('trip_id')->unsigned()->nullable();
            $table->integer('status')->default(0);
            $table->string('region',60);
            $table->double('lng');
            $table->double('lit');
            $table->longText('api_token')->nullable();
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
        Schema::dropIfExists('fathers');
    }
}
