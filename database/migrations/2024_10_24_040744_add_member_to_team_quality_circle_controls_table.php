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
        Schema::table('team_quality_circle_controls', function (Blueprint $table) {
            $table->string('member');
            $table->string('fullname')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_quality_circle_controls', function (Blueprint $table) {
            $table->dropColumn('member');
            $table->dropColumn('fullname');
        });
    }
};
