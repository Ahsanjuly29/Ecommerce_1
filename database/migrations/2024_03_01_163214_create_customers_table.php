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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->string('company_name');
            $table->string('slug')->comment('company name slug');

            $table->string('mobile')->unique();
            $table->string('phone')->nullable();

            $table->string('email')->nullable();
            $table->string('email2')->nullable();

            $table->text('address')->nullable();
            $table->text('proprietor')->nullable();
            $table->text('desc')->nullable();

            $table->timestamps();

            $table->index('slug');
            $table->index('mobile');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
