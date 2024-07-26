<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQueueNumberAndQrCodeToScreeningsTable extends Migration
{
    public function up()
    {
        Schema::table('screenings', function (Blueprint $table) {
            $table->string('queue_number')->nullable()->after('additional_notes');
            $table->text('qr_code')->nullable()->after('queue_number');
        });
    }

    public function down()
    {
        Schema::table('screenings', function (Blueprint $table) {
            $table->dropColumn(['queue_number', 'qr_code']);
        });
    }
}
