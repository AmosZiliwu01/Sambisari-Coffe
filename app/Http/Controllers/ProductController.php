<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Kategori;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with('kategori')->get();
        return view('backend.content.product.list', compact('product'));
    }
    public function tambah()
    {
        $kategori = Kategori::all();
        return view('backend.content.product.formtambah', compact('kategori'));
    }
    public function prosesTambah(Request $request)
    {
        $this->validate($request, [
            'judul_product' => 'required',
            'isi_product' => 'required' ,
            'id_kategori' => 'required' ,
            'gambar_product' => 'required'
        ]);

        $request->file('gambar_product')->store('public');
        $gambar_product = $request->file('gambar_product')->hashName();

        $product = new Product();
        $product->judul_product = $request->judul_product;
        $product->isi_product = $request->isi_product;
        $product->id_kategori = $request->id_kategori;
        $product->gambar_product = $gambar_product;

        try {
            $product->save();
            return redirect(route('product.index'))->with('pesan', ['success','Berhasil tambah product']);
        }catch (\Exception $e){
            return redirect(route('product.index'))->with('pesan', ['danger','Gagal tambah product']);
        }
    }
    public function ubah($id)
    {
        $kategori = Kategori::all();
        $product = Product::findOrFail($id);
        return view('backend.content.product.formUbah', compact('product', 'kategori'));
    }
    public function prosesubah(Request $request)
    {
        $this->validate($request, [
            'judul_product' => 'required',
            'isi_product' => 'required' ,
            'id_kategori' => 'required'
        ]);

        $product = Product::findOrFail($request->id_product);
        $product->judul_product = $request->judul_product;
        $product->isi_product = $request->isi_product;
        $product->id_kategori = $request->id_kategori;

        if($request->hasFile('gambar_product')){
            $request->file('gambar_product')->store('public');
            $gambar_product = $request->file('gambar_product')->hashName();
            $product->gambar_product = $gambar_product;
        }

        try {
            $product->save();
            return redirect(route('product.index'))->with('pesan', ['success','Berhasil ubah product']);
        }catch (\Exception $e){
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
