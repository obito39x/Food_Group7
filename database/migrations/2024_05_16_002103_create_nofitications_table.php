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
        Schema::create('nofitications', function (Blueprint $table) {
            $table->id();
            $table->int('user_id'); 
            $table->string('type'); 
            $table->text('data'); 
            $table->boolean('is_read')->default(false); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nofitications');
    }
};
