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
            // Añadir eliminación en cascada para que cuando un evento se elimine, se elimine a su par la reserva
            
            // Asegúrate que event_id exista y sea unsignedBigInteger (o el tipo que uses)
            $table->unsignedBigInteger('event_id')->change();

            // Añadimos la clave foránea con cascada al borrar evento
            $table->foreign('event_id')
                ->references('id')->on('events')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Eliminar la clave foránea
            $table->dropForeign(['event_id']);
        });
    }
};
