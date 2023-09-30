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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cat_id')->unsigned();
            $table->bigInteger('type_id')->unsigned();
            $table->string('name');
            $table->string('measurement');
            $table->string('description');
            $table->timestamps();
            $table->foreign('cat_id')->references('id')->on('med_categories');
            $table->foreign('type_id')->references('id')->on('med_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
