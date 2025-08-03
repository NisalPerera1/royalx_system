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
        Schema::create('clients', function (Blueprint $table) {
   
            $table->uuid('id')->primary(); // UUID primary key

            $table->string('name');
            $table->string('contact');
            $table->string('address')->nullable();
            $table->string('id_proof')->nullable();
            $table->string('id_proof_file')->nullable(); // NIC/BR image path (file)

            $table->string('guarantor')->nullable();
            
            $table->timestamps(); // ✅ Only once
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
