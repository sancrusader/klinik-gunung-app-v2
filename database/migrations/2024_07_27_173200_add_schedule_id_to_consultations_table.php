<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScheduleIdToConsultationsTable extends Migration
{
    public function up()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->foreignId('schedule_id')->nullable()->constrained('schedules')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropForeign(['schedule_id']);
            $table->dropColumn('schedule_id');
        });
    }
}

