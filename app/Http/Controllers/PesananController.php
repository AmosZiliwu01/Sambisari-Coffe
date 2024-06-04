<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ItemPesanan;

class PesananController extends Controller
{
    public function index()
    {
        $id = Auth::guard('user')->user()->id;
        $user = User::findOrFail($id);
        if($user->role == 'pelanggan'){
            $pesanans = Pesanan::where('iduser',$id)->orderByDesc('created_at')->get();
        }else{
            $pesanans = Pesanan::orderByDesc('created_at')->get();
        }
        $products = Product::all();

        return view('backend.content.pesanan.listPesanan', [
            'pesanans' => $pesanans,
            'products' => $products,
        ]);
    }

    public function tambah()
    {
        $products = Product::all();

        return view('backend.content.pesanan.formTambah', compact('products'));
    }

    public function prosesTambah(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama_pelanggan' => 'required|string',
            'total_harga' => 'required|numeric',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
        ]);


        // Simpan data pesanan ke dalam database
        $pesananData = $request->all();
        $pesananData['status'] = 'Pending'; // Set default status
        $pesananData['iduser'] = Auth::guard('user')->user()->id; // Set default status
        $pesanan = Pesanan::create($pesananData);

        foreach ($request->products as $key => $idproduct){
            $itemPesanan = new ItemPesanan();
            $itemPesanan->idpesanan = $pesanan->id;
            $itemPesanan->idproduct = $idproduct;
            $itemPesanan->qty = $request->jumlah[$key];
            $itemPesanan->save();
        }

        // Redirect dengan flash message
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil disimpan.');
    }

    public function detail($idPesanan)
    {
        $itemPesanan = ItemPesanan::with('product')->where('idpesanan',$idPesanan)->get();
//        foreach ($itemPesanan as $ip) {
//            $product = $ip->product->name;
//            $qty = $ip->qty;
//        }
        return view('backend.content.pesanan.detailPesanan', [
           'itemPesanan' => $itemPesanan,
        ]);
    }

    public function ubah($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('pesanan.edit', compact('pesanan'));
    }

    public function prosesUbah(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama_pelanggan' => 'required|string',
            'total_harga' => 'required|numeric',
            'product_id' => 'nullable|exists:products,id',
        ]);

        // Update data pesanan di dalam database
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($request->all());

        // Redirect dengan flash message
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function hapus($id)
    {
        // Hapus data pesanan dari database
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        // Redirect dengan flash message
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
    public function updateStatus($id, $status)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $status;

        // Jika status diubah menjadi "Selesai"
        if ($status === 'Selesai') {
            // Dapatkan item-item yang terkait dengan pesanan ini
            $items = $pesanan->items()->get();

            // Proses setiap item untuk mengubah status menjadi "No"
            foreach ($items as $item) {
                $item->status = 'No';
                $item->save();
            }
        }

        $pesanan->save();

        return redirect()->back()->with('status', 'Status updated successfully');
    }

    public function deleteAll()
    {
        // Delete all pesanan
        Pesanan::truncate();

        // Delete all item pesanan
        ItemPesanan::truncate();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'All pesanan and their details have been deleted.');
    }
}
