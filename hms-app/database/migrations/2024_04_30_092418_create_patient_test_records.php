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
        Schema::create('patient_test_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_test_id');
            $table->json('test_category');
            $table->json('test_name');
            $table->json('test_cost');
            $table->unsignedBigInteger('total_cost');
            $table->date('test_delivery_date');
            $table->string('test_status');
            $table->foreign('patient_test_id')
                ->references('id')
                ->on('patient_tests')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_test_records');
    }
};
