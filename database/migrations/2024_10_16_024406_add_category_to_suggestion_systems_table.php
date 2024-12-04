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
            $table->string('category_saving_id')->nullable();
            $table->string('category_corporate_id')->nullable();
            $table->string('category_impact_id')->nullable();
            $table->string('category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suggestion_systems', function (Blueprint $table) {
            $table->dropColumn('category_saving_id');
            $table->dropColumn('category_corporate_id');
            $table->dropColumn('category_impact_id');
            $table->dropColumn('category_id');
        });
    }
};
