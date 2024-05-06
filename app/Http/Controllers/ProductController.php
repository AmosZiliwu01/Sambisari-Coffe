<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(5);
        return view('backend.content.product.list', compact('products'));

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

        $products = new Product();
        $products->barcode = $request->barcode;
        $products->name = $request->name;
        $products->price = $request->price;
        $products->isi_product = $request->isi_product;
        $products->id_kategori = $request->id_kategori;
        $products->gambar_product = $gambar_product;

        try {
            $products->save();
            return redirect(route('product.index'))->with('pesan', ['success', 'Berhasil tambah product']);
        } catch (\Exception $e) {
            return redirect(route('product.index'))->with('pesan', ['danger', 'Gagal tambah product']);
        }
    }


    public function ubah($id)
    {
        $kategori = Kategori::all();
        $products = Product::findOrFail($id);
        return view('backend.content.product.formUbah', compact('products','kategori'));
    }

    public function prosesUbah(Request $request)
    {
        $this->validate($request, [
            'barcode' => 'required',
            'name' => 'required',
            'price' => 'required',
            'isi_product' => 'required',
            'id_kategori' => 'required',
        ]);

        $products = Product::findOrFail($request->id);
        $products->barcode = $request->barcode;
        $products->name = $request->name;
        $products->price = $request->price;
        $products->isi_product = $request->isi_product;
        $products->id_kategori = $request->id_kategori;

        if($request->hasFile('gambar_product')){
            $request->file('gambar_product')->store('public');
            $gambar_product = $request->file('gambar_product')->hashName();
            $products->gambar_product = $gambar_product;
        }

        try {
            $products->save();
            return redirect(route('product.index'))->with('pesan', ['success','Berhasil ubah product']);
        }catch (\Exception $e){
            return redirect(route('product.index'))->with('pesan', ['danger','Gagal ubah product']);
        }

    }

    public function hapus($id)
    {
        $products = Product::findOrFail($id);

        try {
            $product->delete();
            return redirect(route('product.index'))->with('pesan', ['success','Berhasil hapus product']);
        }catch (\Exception $e){
            return redirect(route('product.index'))->with('pesan', ['danger','Gagal hapus product']);
        }
    }
}
