<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $rows = Transaction::query()->get();
        // Calculate total semua transaksi
        $totalSemuaTransaksi = 0;
        foreach ($rows as $row) {
            $totalSemuaTransaksi += $row->total;
        }

        // Pass $rows and $totalSemuaTransaksi to the view
        return view('backend.content.transaction.list', compact('rows', 'totalSemuaTransaksi'));

    }

    public function generatePDF()
    {
        $rows = Transaction::all(); // Or fetch transactions as needed

        $pdf = PDF::loadView('backend.content.transaction.print-pdf', compact('rows'));

        return $pdf->download('transactions.pdf');
    }
    public function delete($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect()->back()->with('success', 'Transaction deleted successfully');
    }

}
