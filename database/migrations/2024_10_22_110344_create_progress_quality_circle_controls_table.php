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
        Schema::create('progress_quality_circle_controls', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id', 'fk_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->uuid('quality_circle_control_id');
            $table->foreign('quality_circle_control_id', 'fk_qc_control_id')->references('id')->on('quality_circle_controls')->onDelete('cascade');

            $table->string('step');
            $table->string('deskripsi');
            $table->text('notulensi');
            $table->text('lampiran');

            $table->integer('approval')->default(101);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_quality_circle_controls');
    }
};
