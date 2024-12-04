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
        Schema::create('quality_circle_controls', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('fasilitator');

            $table->string('tema')->nullable();
            $table->string('team')->nullable();
            $table->integer('jumlah_tema')->default(1);

            $table->string('category_saving_id')->nullable();
            $table->string('category_corporate_id')->nullable();
            $table->string('category_impact_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('category_improvment_id')->nullable();
            $table->string('nomorQCC')->nullable();

            $table->integer('approval')->default(101);
            $table->enum('status', ['publish', 'draft'])->default('publish');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quality_circle_controls');
    }
};
