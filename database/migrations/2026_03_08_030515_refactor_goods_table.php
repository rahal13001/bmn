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
        // Clear old data to prevent constraint errors when adding required columns
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('borrow_good')->truncate();
        \Illuminate\Support\Facades\DB::table('borrows')->truncate();
        \Illuminate\Support\Facades\DB::table('maintenances')->truncate();
        \Illuminate\Support\Facades\DB::table('goods')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        Schema::table('goods', function (Blueprint $table) {
            // Drop constraint first to modify the column
            $table->dropForeign(['group_id']);
        });

        Schema::table('goods', function (Blueprint $table) {
            $table->string('name')->after('id_bmn');
            $table->string('nup')->after('name');
            $table->string('brand')->after('nup');
            $table->string('ownership')->nullable()->after('condition');

            $table->foreignId('group_id')->nullable()->change();
            $table->enum('condition', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->nullable()->change();
            $table->decimal('acquisition_price', 15, 2)->nullable()->change();

            // Re-add constraint
            $table->foreign('group_id')->references('id')->on('groups')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
        });

        Schema::table('goods', function (Blueprint $table) {
            $table->dropColumn(['name', 'nup', 'brand', 'ownership']);
            
            $table->foreignId('group_id')->nullable(false)->change();
            $table->enum('condition', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->nullable(false)->change();
            $table->decimal('acquisition_price', 15, 2)->nullable(false)->change();

            $table->foreign('group_id')->references('id')->on('groups')->cascadeOnDelete();
        });
    }
};
