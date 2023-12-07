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
        Schema::create('slot_rowers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_rower');
            $table->foreign('ref_rower')->references('id')->on('users')->cascadeOnDelete();;
            $table->unsignedBigInteger('ref_slot');
            $table->foreign('ref_slot')->references('id')->on('slots')->cascadeOnDelete();;
            $table->boolean('reserved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_rowers');
    }
};
