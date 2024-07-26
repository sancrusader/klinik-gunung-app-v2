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
        Schema::table('screenings', function (Blueprint $table) {
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
        });
    }

    public function down()
    {
        Schema::table('screenings', function (Blueprint $table) {
            $table->dropColumn('payment_status');
        });
    }
};
