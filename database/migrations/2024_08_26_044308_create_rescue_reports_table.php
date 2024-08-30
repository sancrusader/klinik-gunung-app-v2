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
        Schema::create('rescue_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rescue_operation_id')->constrained()->onDelete('cascade');
            $table->text('report_details');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rescue_reports');
    }
};
