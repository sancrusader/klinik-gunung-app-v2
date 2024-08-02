<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQrCodeSentToScreeningsTable extends Migration
{
    public function up()
    {
        Schema::table('screenings', function (Blueprint $table) {
            $table->boolean('qr_code_sent')->default(false); // Menambahkan kolom dengan nilai default false
        });
    }

    public function down()
    {
        Schema::table('screenings', function (Blueprint $table) {
            $table->dropColumn('qr_code_sent'); // Menghapus kolom jika migrasi dibatalkan
        });
    }
}
