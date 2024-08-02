<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreeningOfflinesTable extends Migration
{
    public function up()
    {
        Schema::create('screening_offlines', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('queue_number')->unique();
            $table->boolean('health_check_result')->nullable();
            $table->boolean('payment_status')->default(false);
            $table->boolean('certificate_issued')->default(false);
            $table->string('certificate_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('screening_offlines');
    }
}

