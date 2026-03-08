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
        Schema::table('borrows', function (Blueprint $table) {
            $table->dropForeign(['good_id']);
            $table->dropColumn(['good_id', 'borrow_condition', 'return_condition']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrows', function (Blueprint $table) {
            $table->foreignId('good_id')->constrained('goods')->cascadeOnDelete();
            $table->text('borrow_condition');
            $table->text('return_condition')->nullable();
        });
    }
};
