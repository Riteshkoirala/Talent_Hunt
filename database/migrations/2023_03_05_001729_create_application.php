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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seeker_id');
            $table->unsignedBigInteger('post_id');
            $table->text('status');
            $table->string('link')->default('wait');
            $table->timestamps();
            $table->foreign('seeker_id')->references('id')->on('seeker_profiles');
            $table->foreign('post_id')->references('id')->on('job_posts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application');
    }
};
