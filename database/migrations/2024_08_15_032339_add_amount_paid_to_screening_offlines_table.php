<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('screening_offlines', function (Blueprint $table) {
            $table->decimal('amount_paid', 10, 2)->nullable()->after('payment_status');
        });
    }

    public function down()
    {
        Schema::table('screening_offlines', function (Blueprint $table) {
            $table->dropColumn('amount_paid');
        });
    }

};
