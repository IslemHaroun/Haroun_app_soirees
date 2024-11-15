<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('region')->nullable(); 
            $table->string('city')->nullable();  
            $table->integer('age')->nullable();   
            $table->json('interests')->nullable(); 
            $table->float('rating')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['region', 'city', 'age', 'interests', 'rating']);
        });
    }
};
