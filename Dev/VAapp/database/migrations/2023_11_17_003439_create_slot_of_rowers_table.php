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
        Schema::create('slot_of_rowers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slot_id')->constrained(
                table: 'slots', indexName: 'SlotRower_slot_id'
            );
            $table->foreignId('rower_id')->constrained(
                table: 'users', indexName: 'SlotRower_rower_id'
            );
            $table->boolean('available');
            $table->boolean('reserved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_of_rowers');
    }
};
