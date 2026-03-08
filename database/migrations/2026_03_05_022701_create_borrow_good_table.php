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
        Schema::create('borrow_good', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrow_id')->constrained()->cascadeOnDelete();
            $table->foreignId('good_id')->constrained('goods')->cascadeOnDelete();
            $table->text('borrow_condition');
            $table->text('return_condition')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_good');
    }
};
