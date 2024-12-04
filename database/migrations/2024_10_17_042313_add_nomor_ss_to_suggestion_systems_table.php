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
        Schema::table('suggestion_systems', function (Blueprint $table) {
            $table->string('category_improvment_id')->nullable();
            $table->string('nomorSS')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suggestion_systems', function (Blueprint $table) {
            $table->dropColumn('category_improvment_id');
            $table->dropColumn('nomorSS');
        });
    }
};
