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
        return view('backend.content.transaction.list', [
            'rows' => $rows
        ]);
    }

    public function printPDF($id)
    {
        $row = Transaction::query()->with('ItemTransaction.Product')->first();
        if ($row === null) {
            abort(404);
        }
        //    use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('backend.content.transaction.print-pdf', ['row' => $row])
            ->setPaper('A4');
        return $pdf->stream('Invoice ' . $row->code . '.pdf');

    }
}
