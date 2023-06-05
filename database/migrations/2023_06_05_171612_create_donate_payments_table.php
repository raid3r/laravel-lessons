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
        Schema::create('donate_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('donate_id')->unsigned()->nullable();
            $table->foreign('donate_id')
                  ->references('id')->on("donates");
            $table->decimal('amount');
            $table->string('status', 100);
            $table->string('uid', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donate_payments');
    }
};
