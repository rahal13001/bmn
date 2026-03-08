<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('good_id')->constrained('goods')->cascadeOnDelete();
            $table->string('officer');
            $table->enum('borrower_type', ['internal', 'external']);
            $table->string('borrower');
            $table->string('borrower_phone')->nullable();
            $table->text('borrower_address')->nullable();
            $table->string('borrower_email')->nullable();
            $table->date('borrow_date');
            $table->date('return_date')->nullable();
            $table->text('borrow_condition');
            $table->text('return_condition')->nullable();
            $table->json('borrow_documentation')->nullable();
            $table->json('return_documentation')->nullable();
            $table->string('need');
            $table->text('note')->nullable();
            $table->string('application_letter')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
