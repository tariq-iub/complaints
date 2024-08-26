<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionHandlersTable extends Migration
{
    public function up()
    {
        Schema::create('section_handlers', function (Blueprint $table) {
            $table->id(); // Creates an unsignedBigInteger column `id`
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('employee_id'); // This should match the `id` column in `employees`
            $table->boolean('is_head')->default(true);
            $table->softDeletes();
            $table->timestamps();

            // Define foreign key constraints after creating the columns
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('section_handlers');
    }
}


