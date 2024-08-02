<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHealthCheckResultNullableInScreeningOfflinesTable extends Migration
{
    public function up()
    {
        Schema::table('screening_offlines', function (Blueprint $table) {
            $table->string('health_check_result')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('screening_offlines', function (Blueprint $table) {
            $table->string('health_check_result')->nullable(false)->change();
        });
    }
}
