<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoTable extends Migration
{
    public function up()
    {
        Schema::create('info', function (Blueprint $table) {
            $table->id();
            $table->string('front_image')->nullable();
            $table->string('background_image')->nullable();
            $table->string('main_title');
            $table->text('description');
            $table->string('location_title');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('info');
    }
}
