<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_certificate_and_payment_to_screenings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCertificateAndPaymentToScreeningsTable extends Migration
{
    public function up()
    {
        Schema::table('screenings', function (Blueprint $table) {
            // Tambahkan pengecekan jika kolom belum ada
            if (!Schema::hasColumn('screenings', 'certificate_issued')) {
                $table->boolean('certificate_issued')->default(false)->after('payment_status');
            }
        });
    }

    public function down()
    {
        Schema::table('screenings', function (Blueprint $table) {
            $table->dropColumn(['certificate_issued']);
        });
    }
}
