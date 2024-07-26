<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreeningsTable extends Migration
{
    public function up()
    {
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->string('mountain');
            $table->string('citizenship');
            $table->string('country');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->boolean('question1')->default(false);
            $table->boolean('question2')->default(false);
            $table->boolean('question3')->default(false);
            $table->text('additional_notes')->nullable();
            $table->boolean('screening_passed')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('screenings');
    }
}
