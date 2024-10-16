<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up() {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['Main Course', 'Beverage', 'Dessert']);
            $table->string('image');
            $table->integer('price');
            $table->text('brief_description');
            $table->text('about');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
