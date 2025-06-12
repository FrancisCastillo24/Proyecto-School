<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // Cargo el usuario con sus reservas y eventos a través de reservas
        $transactions = Transaction::with('user.bookings.event', 'user.student')->paginate(10);
        return view('admin.transaction.index', compact('transactions'));
    }

    public function create()
    {
        $users = User::all(); // Para el select de alumnos registrados
        return view('admin.transaction.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'price_per_entry' => 'required|numeric|min:0',
        ]);

        $user = User::with('bookings')->findOrFail($request->user_id);

        // Sumamos la cantidad de todas las reservas para ese usuario
        $quantity = $user->bookings->sum('quantity');

        $total_price = $quantity * $request->price_per_entry;

        Transaction::create([
            'user_id' => $request->user_id,
            'price_per_entry' => $request->price_per_entry,
            'total_price' => $total_price,
        ]);

        return redirect()->route('admin.transaction.index')->with('success', 'Transacción creada con éxito.');
    }

    public function show(Transaction $transaction)
    {
        return view('admin.transaction.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $users = User::all();
        return view('admin.transaction.edit', compact('transaction', 'users'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'price_per_entry' => 'required|numeric|min:0',
        ]);

        $user = User::with('bookings')->findOrFail($request->user_id);

        $quantity = $user->bookings->sum('quantity');

        $transaction->update([
            'user_id' => $request->user_id,
            'price_per_entry' => $request->price_per_entry,
            'total_price' => $quantity * $request->price_per_entry,
        ]);

        return redirect()->route('admin.transaction.index')->with('success', 'Transacción actualizada con éxito.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('admin.transaction.index')->with('success', 'Transacción eliminada con éxito.');
    }
}
