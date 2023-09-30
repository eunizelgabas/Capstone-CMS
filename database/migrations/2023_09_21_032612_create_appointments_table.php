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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->tinyInteger('appointment_no');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('doctor_id');
            $table->string('status', 50);
            // $table->unsignedBigInteger('patient_id');
            $table->timestamps();

            // $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
