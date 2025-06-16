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
        Schema::table('transactions', function (Blueprint $table) {
            // Eliminamos columnas que no usas
            if (Schema::hasColumn('transactions', 'guest_name')) {
                $table->dropColumn('guest_name');
            }
            if (Schema::hasColumn('transactions', 'guest_phone')) {
                $table->dropColumn('guest_phone');
            }
            // Agregamos cantidad (quantity)
            if (!Schema::hasColumn('transactions', 'quantity')) {
                $table->unsignedInteger('quantity')->default(1)->after('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Para revertir
            if (!Schema::hasColumn('transactions', 'guest_name')) {
                $table->string('guest_name')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('transactions', 'guest_phone')) {
                $table->string('guest_phone')->nullable()->after('guest_name');
            }
            if (Schema::hasColumn('transactions', 'quantity')) {
                $table->dropColumn('quantity');
            }
        });
    }
};
