<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHealthAndExperienceColumnsToScreeningofflineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('screening_offlines', function (Blueprint $table) {
            // Kolom untuk kategori kesehatan fisik
            $table->string('physical_health_q1')->nullable();
            $table->string('physical_health_q2')->nullable();
            $table->string('physical_health_q3')->nullable();
            $table->string('physical_health_q4')->nullable();
            $table->string('physical_health_q5')->nullable();
            $table->string('physical_health_q6')->nullable();
            
            // Kolom untuk kategori pengalaman dan pengetahuan
            $table->string('experience_knowledge_q1')->nullable();
            $table->string('experience_knowledge_q2')->nullable();
            $table->string('experience_knowledge_q3')->nullable();
            $table->string('experience_knowledge_q4')->nullable();
            $table->string('experience_knowledge_q5')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('screening_offline', function (Blueprint $table) {
            $table->dropColumn([
                'physical_health_q1',
                'physical_health_q2',
                'physical_health_q3',
                'experience_knowledge_q1',
                'experience_knowledge_q2',
                'experience_knowledge_q3'
            ]);
        });
    }
}
