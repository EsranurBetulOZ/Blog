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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            // $table->string('user_id')->unique();
            $table->string('user_email');
            $table->string('title');
            $table->text('content');
            $table->string('slug')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('imagepath')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
