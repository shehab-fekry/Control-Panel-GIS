<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->integer('age');
            $table->string('class')->nullable();
            $table->string('gender');
            $table->string('image_path')->nullable();
            $table->integer('confirmed')->default(0);
            $table->boolean('status')->default(false);
            $table->integer('father_id')->unsigned();
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
        Schema::dropIfExists('children');
    }
}
