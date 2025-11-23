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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_a_id')->constrained('organizations')->onDelete('cascade');
            $table->foreignId('team_b_id')->constrained('organizations')->onDelete('cascade');
            $table->string('venue');
            $table->dateTime('match_date');
            $table->integer('overs');
            $table->enum('status', ['upcoming', 'live', 'finished'])->default('upcoming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
