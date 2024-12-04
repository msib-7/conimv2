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
        Schema::create('mp_infos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->uuid('mesin_id');
            $table->foreign('mesin_id')->references('id')->on('mesins')->onDelete('cascade');

            $table->string('suggestion_system_id')->nullable();
            $table->string('one_sheet_report_id')->nullable();

            $table->string('ketegori');
            $table->string('section_mesin');
            $table->string('jenis_mesin');
            $table->string('instrument');
            $table->text('sebelumPerubahan');
            $table->text('setelahPerubahan');
            $table->text('alasan');
            $table->text('detail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mp_infos');
    }
};
