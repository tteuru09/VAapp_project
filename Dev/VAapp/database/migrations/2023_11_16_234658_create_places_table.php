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
            $table->integer('position');
            $table->unsignedBigInteger('ref_slot');
            $table->unsignedBigInteger('ref_canoe');
            $table->unsignedBigInteger('rower_id')->nullable();
            $table->foreign(['ref_slot', 'ref_canoe'])
            ->references(['ref_slot', 'ref_canoe'])->on('slot_canoes');           
            $table->foreign('rower_id')
            ->references('id')->on('users');
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
