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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained()->onDelete('cascade');
            $table->string('team_batting')->nullable();
            $table->integer('runs')->default(0);
            $table->integer('wickets')->default(0);
            $table->decimal('overs_completed', 5, 2)->default(0);
            $table->string('striker_name')->nullable();
            $table->string('non_striker_name')->nullable();
            $table->string('bowler_name')->nullable();
            $table->text('last_ball_comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
