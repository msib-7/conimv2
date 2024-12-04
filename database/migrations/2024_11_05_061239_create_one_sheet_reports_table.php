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
        Schema::create('one_sheet_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Yang Buat Creator
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Buat Mesin
            $table->uuid('mesin_id');
            $table->foreign('mesin_id')->references('id')->on('mesins')->onDelete('cascade');

            // FIeld otomatis dari hris
            $table->string('fasilitator');

            $table->text('tema');
            $table->string('lokasi');
            $table->string('nomorCC')->nullable();
            $table->string('nomorOSR')->nullable();

            // Smart
            $table->text('smart_specific')->nullable();
            $table->text('smart_measurable')->nullable();
            $table->text('smart_achievable')->nullable();
            $table->text('smart_reasonable')->nullable();
            $table->text('smart_time')->nullable();

            // Analisa kondisi yang ada (Anakonda)
            $table->text('man_wsbh')->nullable();
            $table->text('man_wah')->nullable();
            $table->text('man_root_cause')->nullable();

            $table->text('machine_wsbh')->nullable();
            $table->text('machine_wah')->nullable();
            $table->text('machine_root_cause')->nullable();

            $table->text('method_wsbh')->nullable();
            $table->text('method_wah')->nullable();
            $table->text('method_root_cause')->nullable();

            $table->text('material_wsbh')->nullable();
            $table->text('material_wah')->nullable();
            $table->text('material_root_cause')->nullable();

            $table->text('environment_wsbh')->nullable();
            $table->text('environment_wah')->nullable();
            $table->text('environment_root_cause')->nullable();

            $table->text('what')->nullable();
            $table->text('who')->nullable();
            $table->text('when')->nullable();
            $table->text('where')->nullable();
            $table->text('why')->nullable();
            $table->text('how')->nullable();

            $table->text('quality')->nullable();
            $table->text('cost')->nullable();
            $table->text('delivery')->nullable();
            $table->text('safety')->nullable();
            $table->text('morale')->nullable();
            $table->text('productivity')->nullable();
            $table->text('environment')->nullable();

            $table->text('standarisasi')->nullable();
            $table->text('nextStep')->nullable();
            $table->string('biaya')->nullable();
            $table->string('costSaving')->nullable();
            $table->text('lampiran')->nullable();

            // STatus
            $table->integer('approval')->default(101);
            $table->enum('status', ['publish', 'draft'])->default('publish');

            $table->string('category_saving_id')->nullable();
            $table->string('category_corporate_id')->nullable();
            $table->string('category_improvment_id')->nullable();
            $table->string('category_impact_id')->nullable();
            $table->string('category_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('one_sheet_reports');
    }
};
