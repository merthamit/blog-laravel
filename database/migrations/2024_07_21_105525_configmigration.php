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
        Schema::create('configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('logo')->default('');
            $table->string('favicon')->default('');
            $table->string('facebook')->default('');
            $table->string('twitter')->default('');
            $table->string('github')->default('');
            $table->string('linkedin')->default('');
            $table->string('youtube')->default('');
            $table->string('instagram')->default('');
            $table->integer('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
