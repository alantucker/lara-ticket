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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->unsignedBigInteger('owner_id');
            $table->string('status')->default('new');
            $table->string('subject');
            $table->text('body');
            $table->integer('priority')->default('1');
            $table->unsignedBigInteger('assigned_to_id')->nullable();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('assigned_to_id')->references('id')->on('users');
            $table->index('owner_id');
            $table->index('assigned_to_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
