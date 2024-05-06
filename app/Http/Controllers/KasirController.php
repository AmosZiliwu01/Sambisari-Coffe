<?php

namespace App\Http\Controllers;

use App\Models\ItemTransaction;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index()
    {
        return view('backend.content.kasir.index');
    }

    public function searchProduct(Request $request)
    {
        $product = Product::query()->where('barcode', $request->barcode)->first();
        if ($product === null) {
            return response()->json([], 404);
        }
        return response()->json($product);
    }

    public function insert(Request $request)
    {
        #database transaction
        DB::beginTransaction();
        try {
            #1. Simpan data transaction
            $prefix = 'INV/' . date('ym') . '/';
            $code = Transaction::getLastCode($prefix);
            $transaction = new Transaction();
            $transaction->code = $code;
            $transaction->date = date('Y-m-d');
            $transaction->subtotal = 0;
            $transaction->discount = 0;
            $transaction->total = 0;
            $transaction->created_by = Auth::id();
            $transaction->save();
            #2. Simpan data item transaction
            $subtotal = 0;
            $itemCount = count($request->price);
            for ($i = 0; $i < $itemCount; $i++) {
                $it = new ItemTransaction();
                $it->id_transaction = $transaction->id;
                $it->id_product = $request->id[$i];
                $it->price = $request->price[$i];
                $it->qty = $request->qty[$i];
                $it->total = (int)$it->price * (int)$it->qty;
                $it->save();
                $subtotal += $it->total;
            }

            $transaction->subtotal = $subtotal;
            $discount = $subtotal * (int)$request->discount / 100;
            $transaction->discount = $request->discount;
            $transaction->total = $subtotal - $discount;
            $transaction->save();
            #commit
            DB::commit();
            return redirect()->back()->with('berhasil', 'Transaksi Berhasil');
        } catch (Exception $e) {
            #rollback
            DB::rollBack();
            return redirect()->back()->with('gagal', 'Transaksi Gagal');
        }
    }
}
