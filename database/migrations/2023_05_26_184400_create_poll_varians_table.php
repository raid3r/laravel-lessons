<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('poll_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('poll_id');
            $table->foreign('poll_id')->references('id')->on("polls");
            $table->string("text", 500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_variants');
    }
};
