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
        Schema::table('progress_quality_circle_controls', function (Blueprint $table) {
            $table->date('start_date');
            $table->date('end_date');
            $table->string('progress');
            $table->text('absensi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('progress_quality_circle_controls', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('progress');
            $table->dropColumn('absensi');
        });
    }
};
