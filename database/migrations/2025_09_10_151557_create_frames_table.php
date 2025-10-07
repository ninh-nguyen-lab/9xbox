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
        Schema::create('frames', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 15, 0)->nullable();
            $table->decimal('sale_price', 15, 0)->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('avatar')->nullable();
            $table->json('album')->nullable();
            $table->string('tags')->nullable();
            $table->text('keywords')->nullable();
            $table->boolean('status')->default(1); // 0 = hidden, 1 = active
            // Quan hệ với frame_types
            $table->unsignedBigInteger('frame_type_id')->nullable();
            $table->foreign('frame_type_id')->references('id')->on('frame_types')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frames');
    }
};
