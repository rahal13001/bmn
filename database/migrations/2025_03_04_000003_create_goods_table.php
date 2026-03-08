<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('id_bmn')->unique();
            $table->foreignId('group_id')->nullable()->constrained('groups')->nullOnDelete();
            $table->string('color')->nullable();
            $table->enum('condition', ['Baik', 'Rusak Ringan', 'Rusak Berat']);
            $table->date('date');
            $table->json('documentation')->nullable();
            $table->text('note')->nullable();
            $table->decimal('acquisition_price', 15, 2);
            $table->decimal('current_price', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
