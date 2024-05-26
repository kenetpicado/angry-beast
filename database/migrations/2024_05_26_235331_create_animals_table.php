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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('gender')->nullable();
            $table->string('race')->nullable();
            $table->float('initial_weight')->nullable();
            $table->float('initial_height')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('photo')->nullable();
            $table->date('adoption_date')->nullable();
            $table->date('entry_date')->nullable();
            $table->date('exit_date')->nullable();
            $table->date('death_date')->nullable();
            $table->string('cause_of_death')->nullable();
            $table->string('status')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
