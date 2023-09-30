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
            $table->bigInteger('user_id')->unsigned();
            $table->date('date');
            $table->time('time');
            $table->string('status');
            $table->bigInteger('doc_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->string('reason')->nullable();
            $table->timestamps();
            $table->foreign('doc_id')->references('id')->on('doctors');
            $table->foreign('user_id')->references('id')->on('users');
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
