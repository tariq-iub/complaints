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
            $table->unsignedBigInteger('category_id');
            $table->enum('priority', ['normal', 'urgent', 'express']);
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('handler_id')->nullable();
            $table->string('photo_path')->nullable();
            $table->timestamp('section_added_at')->nullable();
            $table->timestamp('handler_assigned_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
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
