<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuestion3ToHealthChecksTable extends Migration
{
    public function up()
    {
        Schema::table('health_checks', function (Blueprint $table) {
            $table->boolean('question3')->after('question2');
        });
    }

    public function down()
    {
        Schema::table('health_checks', function (Blueprint $table) {
            $table->dropColumn('question3');
        });
    }
}
