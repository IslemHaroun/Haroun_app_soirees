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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->string('name');  
            $table->string('location');  
            $table->enum('type', ['jeux de société', 'jeux vidéo', 'classique']);  
            $table->dateTime('date_time');  
            $table->integer('remaining_seats');  
            $table->boolean('is_paid');  
            $table->decimal('price', 8, 2)->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};