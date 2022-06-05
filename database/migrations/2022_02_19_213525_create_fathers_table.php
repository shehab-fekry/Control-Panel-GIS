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
            $table->integer('trip_id')->unsigned()->nullable();
            // $table->integer('school_id')->unsigned();
            $table->integer('school_id')->nullable();
            $table->string('name', 30);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image_path')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->string('mobileNumber', 11);
            $table->integer('status')->default(0);
            $table->longText('region')->nullable();
            $table->double('lng')->nullable();
            $table->double('lit')->nullable();
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
