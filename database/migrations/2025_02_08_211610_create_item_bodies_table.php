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
        Schema::create('item_bodies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_header_id')->constrained()->cascadeOnDelete();
            $table->string('item_name', 200);
            $table->decimal('price', 12, 2);
            $table->integer('quantity');
            $table->string('unit', 40);
            $table->date('expired_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_bodies');
    }
};
