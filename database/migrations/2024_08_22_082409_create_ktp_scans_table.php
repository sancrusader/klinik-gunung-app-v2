<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKtpScansTable extends Migration
{
    public function up()
    {
        Schema::create('ktp_scans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nik')->nullable();
            $table->text('address')->nullable();
            $table->string('image_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ktp_scans');
    }
}
