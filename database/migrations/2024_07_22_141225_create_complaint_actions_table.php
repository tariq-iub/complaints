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
        Schema::create('complaint_actions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('complain_id');
            $table->integer('handler_id');
            $table->string('remarks');
            $table->enum('status', ['initiated', 'processing', 'returned', 'fix']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_actions');
    }
};
