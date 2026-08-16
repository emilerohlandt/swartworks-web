<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., PLA, PETG, ABS, TPU
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Add foreign key to existing materials table
        Schema::table('materials', function (Blueprint $table) {
            $table->foreignId('material_category_id')->nullable()->after('id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign(['material_category_id']);
            $table->dropColumn('material_category_id');
        });

        Schema::dropIfExists('material_categories');
    }
};
