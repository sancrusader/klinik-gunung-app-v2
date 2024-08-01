<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedicalDetailsToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (!Schema::hasColumn('appointments', 'medical_notes')) {
                $table->text('medical_notes')->nullable();
            }
            if (!Schema::hasColumn('appointments', 'prescription')) {
                $table->text('prescription')->nullable();
            }
            if (!Schema::hasColumn('appointments', 'examination_photo')) {
                $table->string('examination_photo')->nullable();
            }
            if (!Schema::hasColumn('appointments', 'completed_at')) {
                $table->timestamp('completed_at')->nullable();
            }
            if (!Schema::hasColumn('appointments', 'follow_up_date')) {
                $table->timestamp('follow_up_date')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (Schema::hasColumn('appointments', 'medical_notes')) {
                $table->dropColumn('medical_notes');
            }
            if (Schema::hasColumn('appointments', 'prescription')) {
                $table->dropColumn('prescription');
            }
            if (Schema::hasColumn('appointments', 'examination_photo')) {
                $table->dropColumn('examination_photo');
            }
            if (Schema::hasColumn('appointments', 'completed_at')) {
                $table->dropColumn('completed_at');
            }
            if (Schema::hasColumn('appointments', 'follow_up_date')) {
                $table->dropColumn('follow_up_date');
            }
        });
    }
}

