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
        Schema::create('job_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('title');
            $table->string('department');
            $table->string('qualification');
            $table->string('location');
            $table->text('description');
            $table->boolean('first_submission')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_submissions');
    }
};
