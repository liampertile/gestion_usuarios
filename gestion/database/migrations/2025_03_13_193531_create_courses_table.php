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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio');
            $table->date('fecha_fin'); 
            $table->decimal('precio', 8, 2);
            $table->foreignId('docente_id')->constrained('teachers');
            $table->foreignId('tema_id')->constrained('subjects');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
