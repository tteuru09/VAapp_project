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
        Schema::create('canoes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('numberOfPlace');
            $table->boolean('free');
            $table->foreignId('slot_id')->constrained(
                table: 'slots', indexName: 'canoes_slot_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canoes');
    }
};