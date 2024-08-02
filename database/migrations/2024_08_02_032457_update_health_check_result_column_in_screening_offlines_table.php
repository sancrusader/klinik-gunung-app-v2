<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHealthCheckResultColumnInScreeningOfflinesTable extends Migration
{
    public function up()
    {
        Schema::table('screening_offlines', function (Blueprint $table) {
            $table->string('health_check_result')->change();
        });
    }

    public function down()
    {
        Schema::table('screening_offlines', function (Blueprint $table) {
            $table->integer('health_check_result')->change();
        });
    }
}

