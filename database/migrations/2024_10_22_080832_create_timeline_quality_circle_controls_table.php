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
        Schema::create('timeline_quality_circle_controls', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('quality_circle_control_id');
            // $table->uuid('quality_circle_control_id');
            // $table->foreign('quality_circle_control_id')->references('id')->on('quality_circle_controls')->onDelete('cascade');

            $table->string('step');
            $table->date('plan_start');
            $table->date('plan_end');
            $table->date('actual_start')->nullable();
            $table->date('actual_end')->nullable();
            $table->enum('status', ['ontime', 'overdue', 'onprogres'])->default('onprogres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeline_quality_circle_controls');
    }
};
