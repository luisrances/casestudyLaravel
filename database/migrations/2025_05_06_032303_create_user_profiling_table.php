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
        Schema::create('user_profilings', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->date('birthdate')->nullable();
            $table->string('sex')->nullable();
            $table->float('height')->nullable(); // cm or inches
            $table->float('weight')->nullable(); // kg or lbs

            $table->json('activity_type')->nullable(); // multiple values
            $table->json('terrain')->nullable();       // multiple values

            $table->string('experience_level')->nullable();

            $table->boolean('maintenance')->default(false);   // yes/no as boolean
            $table->boolean('custom_parts')->default(false);  // yes/no as boolean

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profilings');
    }
};
