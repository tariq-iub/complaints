<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('detail')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->enum('priority', ['normal', 'urgent', 'express']);
            $table->unsignedBigInteger('section_id')->nullable(); // Allow NULL values
            $table->unsignedBigInteger('handler_id')->nullable(); // Changed to unsignedBigInteger
            $table->string('photo_path')->nullable();
            $table->timestamp('section_added_at')->nullable();
            $table->timestamp('handler_assigned_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
