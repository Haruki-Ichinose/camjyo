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
        Schema::create('exports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('h_scode_9digits_id')->constrained()->cascadeOnDelete();
            $table->foreignId('countries_id')->constrained()->cascadeOnDelete();
            $table->string('label');
            $table->text('imformation');
            $table->text('URL');
            $table->foreignId('parents_id')->constrained()->cascadeOnDelete();
            $table->foreignId('child_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imformations');
    }
};
