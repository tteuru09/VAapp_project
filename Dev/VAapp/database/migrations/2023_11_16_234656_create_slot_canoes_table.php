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
        Schema::create('slot_canoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_slot');
            $table->unsignedBigInteger('ref_canoe');
            $table->foreign('ref_slot')->references('id')->on('slots')->cascadeOnDelete();
            $table->foreign('ref_canoe')->references('id')->on('canoes')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_canoes');
    }
};
