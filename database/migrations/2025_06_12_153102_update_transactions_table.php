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
            // Eliminar campos innecesarios si existen
            if (Schema::hasColumn('transactions', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('transactions', 'phone')) {
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('transactions', 'quantity')) {
                $table->dropColumn('quantity');
            }

            // Asegurarse que price_per_entry y total_price existen
            if (!Schema::hasColumn('transactions', 'price_per_entry')) {
                $table->decimal('price_per_entry', 10, 2)->default(0.00);
            }

            if (!Schema::hasColumn('transactions', 'total_price')) {
                $table->decimal('total_price', 10, 2)->default(0.00);
            }

            // Asegurar relación con users
            if (!Schema::hasColumn('transactions', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->index();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'price_per_entry', 'total_price']);
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->integer('quantity')->default(1);
        });
    }
};
