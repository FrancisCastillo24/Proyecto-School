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
        Schema::table('bookings', function (Blueprint $table) {
            Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['date_id']); // Si tenía clave foránea
            $table->dropColumn('date_id');
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Revierto el cambio de eliminar el campo date_id
            Schema::table('bookings', function (Blueprint $table) {
                $table->unsignedBigInteger('date_id')->nullable();
                $table->foreign('date_id')->references('id')->on('event')->onDelete('cascade');
            });
        });
    }
};
