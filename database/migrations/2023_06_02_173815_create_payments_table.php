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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('description', 500);
            $table->bigInteger('order_id')->unique();
            $table->string('card_mask', 20);
            $table->string('currency', 10);
            $table->double('amount', 8,5);
            $table->string('result', 20);
            $table->string('liqpay_order_id', 50);
            $table->string('status', 30);
            $table->string('payment_id', 30);
            $table->string('paytype', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
