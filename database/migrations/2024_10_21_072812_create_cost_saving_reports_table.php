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
        Schema::create('cost_saving_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('fasilitator');

            $table->string('tema')->nullable();
            $table->text('sebelum')->nullable();
            $table->text('sesudah')->nullable();
            $table->decimal('cost_saving', 10, 2)->nullable();
            $table->text('lampiran')->nullable();

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
        Schema::dropIfExists('cost_saving_reports');
    }
};
