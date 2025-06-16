<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user.student')->paginate(10);
        return view('admin.transaction.index', compact('transactions'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.transaction.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'price_per_entry' => 'required|numeric|min:0',
            'enrollment_fee' => 'nullable|numeric|min:0',
        ]);

        $enrollment_fee = $request->input('enrollment_fee', 0);

        $total_price = $request->price_per_entry + $enrollment_fee;

        Transaction::create([
            'user_id' => $request->user_id,
            'price_per_entry' => $request->price_per_entry,
            'enrollment_fee' => $enrollment_fee,
            'total_price' => $total_price,
        ]);

        return redirect()->route('admin.transaction.index')->with('success', 'Transacción creada correctamente.');
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
            'enrollment_fee' => 'required|numeric|min:0',
            'price_per_entry' => 'required|numeric|min:0',
        ]);

        $transaction->update([
            'user_id' => $request->user_id,
            'enrollment_fee' => $request->enrollment_fee,
            'price_per_entry' => $request->price_per_entry,
            // Calcula total_price si aplica
            'total_price' => $request->enrollment_fee + $request->price_per_entry,
        ]);

        return redirect()->route('admin.transaction.index')->with('success', 'Transacción actualizada.');
    }


    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('admin.transaction.index')->with('success', 'Transacción eliminada con éxito.');
    }
}
