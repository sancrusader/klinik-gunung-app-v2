<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::table('screening_offlines', function (Blueprint $table) {
        $table->integer('age')->nullable();
        $table->enum('gender', ['male', 'female', 'other'])->nullable();
        $table->string('contact_number')->nullable();
        $table->date('planned_hiking_date')->nullable();
        $table->integer('previous_hikes_count')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::table('screening_offlines', function (Blueprint $table) {
        $table->dropColumn(['age', 'gender', 'contact_number', 'planned_hiking_date', 'previous_hikes_count']);
    });
}
};
