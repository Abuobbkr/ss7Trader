<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique(); // Unique username
            $table->string('email')->unique(); // Email will be validated by Laravel's email validation
            $table->string('password'); // Password will be validated in the request (alphanumeric)
            $table->date('expire_date')->default(Carbon::now()->addMonth()); // Default to one month from now
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};
