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
        Schema::create('appointment_schedule', function (Blueprint $table) {
            $table->id();
            $table->string('appointment');
            $table->integer('app_number');
            // $table->integer('pat_id');
            // $table->integer('service_id');
            $table->date('date');
            $table->string('status');
            $table->time('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_schedule');
    }
};
