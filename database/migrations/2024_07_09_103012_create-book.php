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
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('title');
            $table->string('author');
            $table->string('genre');
            $table->string('IssuedPrice');
            $table->string('SellingPrice');
            $table->boolean('issued')->default(false);
            $table->uuid('user_id')->nullable(); // Foreign key to users table
            $table->timestamps(); // created_at and updated_at

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
