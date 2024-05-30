<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('kategori')->get();
        return view('backend.content.product.list', ['products' => $products]);

    }

    public function tambah()
    {
        $kategori = Kategori::all();
        return view('backend.content.product.formtambah', compact('kategori'));
    }

    public function prosesTambah(Request $request)
    {
        $this->validate($request, [
            'barcode' => 'required',
            'name' => 'required',
            'price' => 'required',
            'isi_product' => 'required',
            'gambar_product' => 'required', // tambahkan validasi untuk tipe gambar dan ukuran maksimal
        ]);

        $request->file('gambar_product')->store('public');
        $gambar_product = $request->file('gambar_product')->hashName();

        $product = new Product();
        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->isi_product = $request->isi_product;
        $product->id_kategori = $request->id_kategori;
        $product->gambar_product = $gambar_product;

        try {
            $product->save();
            return redirect(route('product.index'))->with('pesan', ['success', 'Berhasil tambah product']);
        } catch (\Exception $e) {
            return redirect(route('product.index'))->with('pesan', ['danger', 'Gagal tambah product']);
        }
    }


    public function ubah($id)
    {
        $kategori = Kategori::all();
        $product = Product::findOrFail($id);
        return view('backend.content.product.formUbah', compact('product','kategori'));
    }

    public function prosesUbah(Request $request)
    {
        $this->validate($request, [
            'barcode' => 'required',
            'name' => 'required',
            'price' => 'required',
            'isi_product' => 'required',
            'id_kategori' => 'required',
            'gambar_product' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // validasi untuk tipe gambar dan ukuran maksimal
        ]);

        // Temukan produk yang akan diubah berdasarkan ID
        $product = Product::findOrFail($request->id);
        // Set nilai atribut baru berdasarkan data yang diterima dari formulir
        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->isi_product = $request->isi_product;
        $product->id_kategori = $request->id_kategori;

        // Cek apakah ada file gambar yang diunggah oleh pengguna
        if($request->hasFile('gambar_product')){
            // Simpan gambar baru
            $gambar_product = $request->file('gambar_product')->store('public');
            // Ambil nama file yang disimpan
            $gambar_product_name = basename($gambar_product);
            // Update kolom gambar_product dalam database
            $product->gambar_product = $gambar_product_name;
        }

        try {
            // Simpan perubahan pada database
            $product->save();
            // Redirect ke halaman produk dengan pesan sukses
            return redirect(route('product.index'))->with('pesan', ['success','Berhasil ubah product']);
        }catch (\Exception $e){
            // Redirect ke halaman produk dengan pesan error jika terjadi kesalahan
            return redirect(route('product.index'))->with('pesan', ['danger','Gagal ubah product']);
        }
    }



    public function hapus($id)
    {
        $product = Product::findOrFail($id);

        try {
            $product->delete();
            return redirect(route('product.index'))->with('pesan', ['success','Berhasil hapus product']);
        }catch (\Exception $e){
            return redirect(route('product.index'))->with('pesan', ['danger','Gagal hapus product']);
        }
    }
}
