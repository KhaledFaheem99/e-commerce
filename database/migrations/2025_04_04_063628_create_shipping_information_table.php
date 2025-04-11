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
        Schema::create('shipping_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->string('user_name');
            $table->string('address');
            $table->integer('first_phone');
            $table->integer('second_phone')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
};
