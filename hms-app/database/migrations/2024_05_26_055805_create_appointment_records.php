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
        Schema::create('appointment_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('patient_name');
            $table->unsignedBigInteger('doctor_id');
            $table->string('doctor_name');
            $table->date('appointment_date');
            $table->string('appointment_day');
            $table->time('appointment_time');
            $table->unsignedBigInteger('appointment_serial');
            $table->string('reason');
            $table->string('status');
            $table->foreign('patient_id')
                ->references('id')
                ->on('patient_records')
                ->onDelete('cascade');
            // $table->unique(['appointment_date', 'appointment_time']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_records');
    }
};
