<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentConfirmedAndCertificateIssuedToScreeningsTable extends Migration
{
    public function up()
    {
        Schema::table('screenings', function (Blueprint $table) {
            if (!Schema::hasColumn('screenings', 'payment_confirmed')) {
                $table->boolean('payment_confirmed')->default(false);
            }

            if (!Schema::hasColumn('screenings', 'certificate_issued')) {
                $table->boolean('certificate_issued')->default(false);
            }
        });
    }

    public function down()
    {
        Schema::table('screenings', function (Blueprint $table) {
            if (Schema::hasColumn('screenings', 'payment_confirmed')) {
                $table->dropColumn('payment_confirmed');
            }

            if (Schema::hasColumn('screenings', 'certificate_issued')) {
                $table->dropColumn('certificate_issued');
            }
        });
    }
}
