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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('recruiter_id');
            $table->text('title');
            $table->text('location');
            $table->dateTime('deadline');
            $table->longText('description');
            $table->LongText('responsibility');
            $table->LongText('qualification');
            $table->LongText('experience');
            $table->integer('vacancy');
            $table->LongText('benefit');
            $table->unsignedBigInteger('type_id');
            $table->timestamps();
            $table->foreign('recruiter_id')->references('id')->on('recruiter_profiles');
            $table->foreign('type_id')->references('id')->on('job_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
