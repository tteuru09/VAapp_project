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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->boolean('available');
            $table->integer('position');
            $table->foreignId('canoe_id')->constrained(
                table: 'canoes', indexName: 'place_canoe_id'
            );
            $table->foreignId('rower_id')->constrained(
                table: 'users', indexName: 'place_rower_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
