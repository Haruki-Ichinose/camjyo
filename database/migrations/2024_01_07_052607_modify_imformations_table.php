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
        Schema::table('imformations', function (Blueprint $table) {
         $table->renameColumn('imformation', 'description');

        $table->renameColumn('parents_id', 'parent_id');

         $table->integer('label')->change();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('imformations', function (Blueprint $table) {
            //
        });
    }
};
