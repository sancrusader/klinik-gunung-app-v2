<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_certificate_path_to_screenings_table.php
// database/migrations/2024_07_31_070624_add_certificate_path_columns_to_screenings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCertificatePathColumnsToScreeningsTable extends Migration
{
    public function up()
    {
        Schema::table('screenings', function (Blueprint $table) {
            $table->string('certificate_path')->nullable()->after('certificate_issued');
        });
    }

    public function down()
    {
        Schema::table('screenings', function (Blueprint $table) {
            $table->dropColumn('certificate_path');
        });
    }
}

