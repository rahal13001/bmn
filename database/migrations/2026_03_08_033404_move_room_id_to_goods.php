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
        // Clear old data to prevent constraint errors
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('borrow_good')->truncate();
        \Illuminate\Support\Facades\DB::table('borrows')->truncate();
        \Illuminate\Support\Facades\DB::table('maintenances')->truncate();
        \Illuminate\Support\Facades\DB::table('goods')->truncate();
        \Illuminate\Support\Facades\DB::table('groups')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        Schema::table('groups', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropColumn('room_id');
        });

        Schema::table('goods', function (Blueprint $table) {
            $table->foreignId('room_id')->nullable()->after('date')->constrained('rooms')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropColumn('room_id');
        });

        Schema::table('groups', function (Blueprint $table) {
            $table->foreignId('room_id')->nullable()->constrained('rooms')->nullOnDelete();
        });
    }
};
