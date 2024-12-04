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
        Schema::create('teams_quality_circle_projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->uuid('quality_circle_project_id');
            $table->foreign('quality_circle_project_id', 'fk_teams_qc_projects_qc_project_id')->references('id')->on('quality_circle_projects')->onDelete('cascade'); // Ganti nama constraint agar unik
            $table->string('member');
            $table->string('fullname')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams_quality_circle_projects');
    }
};
