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
        Schema::create('task_tag', function (Blueprint $table) {

            $table->primary(['task_id', 'tags_id']);

            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->foreignId('tags_id')->constrained()->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_tag');
    }
};
