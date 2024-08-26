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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name');
            $table->string('cnic');
            $table->date('birth_date');
            $table->string('gender');
            $table->foreignId('designation_id')->constrained();
            $table->string('email')->unique();
            $table->string('mobile_no');
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->date('joining_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Drop the soft deletes column
        });
        Schema::dropIfExists('employees'); // Drop the table
    }
};
