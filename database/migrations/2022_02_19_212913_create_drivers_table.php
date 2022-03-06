<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_id')->unsigned()->nullable();
            $table->integer('school_id')->unsigned();
            $table->string('name',30);
            $table->string('image_path')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('licenseNumber',20)->unique();
            $table->boolean('confirmed')->default(false);
            $table->string('mobileNumber', 15);
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
        Schema::dropIfExists('drivers');
    }
}
