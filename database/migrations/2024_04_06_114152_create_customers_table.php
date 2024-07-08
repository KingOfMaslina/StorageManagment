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
            $table->string('name');
            $table->string('business');
            $table->string('boss');
            $table->string('boss_last_name');
            $table->string('boss_father_name');
            $table->foreignId('address_id')->constrained()->onDelete('cascade');
            $table->string('phone');
            $table->string('email');
            $table->string('inn');
            $table->timestamps();
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
