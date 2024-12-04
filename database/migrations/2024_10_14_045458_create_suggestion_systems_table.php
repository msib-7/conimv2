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
        Schema::create('suggestion_systems', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->uuid('mesin_id');
            $table->foreign('mesin_id')->references('id')->on('mesins')->onDelete('cascade');
            $table->string('fasilitator');

            $table->string('tema')->nullable();
            $table->string('lokasi')->nullable();
            $table->text('permasalahan')->nullable();
            $table->text('improvment')->nullable();
            $table->decimal('biaya', 10, 2)->nullable();
            $table->text('uraian_biaya')->nullable();
            $table->decimal('cost_saving', 10, 2)->nullable();
            $table->text('keuntungan')->nullable();
            $table->string('kondisi_sebelum')->nullable(); // File gambar
            $table->string('kondisi_sesudah')->nullable(); // File gambar
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
        Schema::dropIfExists('suggestion_systems');
    }
};
