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
        $messages = [
            'barcode.required' => 'Barcode tidak boleh kosong.',
            'barcode.unique' => 'Barcode sudah pernah digunakan, tidak boleh sama.',
            'name.required' => 'Nama tidak boleh kosong.',
            'price.required' => 'Harga tidak boleh kosong.',
            'isi_product.required' => 'Deskripsi produk tidak boleh kosong.',
            'gambar_product.required' => 'Gambar produk tidak boleh kosong.',
            'gambar_product.image' => 'File harus berupa gambar.',
            'gambar_product.max' => 'Ukuran gambar maksimal 2MB.',
        ];

        $this->validate($request, [
            'barcode' => 'required|unique:products,barcode',
            'name' => 'required',
            'price' => 'required',
            'isi_product' => 'required',
            'gambar_product' => 'required|image|max:2048', // added validation for image type and size
        ], $messages);

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
            'barcode' => 'required|unique:products,barcode,' . $request->id,
            'name' => 'required',
            'price' => 'required',
            'isi_product' => 'required',
            'id_kategori' => 'required',
        ]);

        $product = Product::findOrFail($request->id);
        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->price = $request->price;
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
        } catch (\Exception $e) {
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
    public function destroyPermanently($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->forceDelete(); // Menghapus produk secara permanen
        return redirect()->back()->with('pesan', ['success', 'Produk berhasil dihapus permanen']);
    }
    public function trashedProducts()
    {
        $trashedProducts = Product::onlyTrashed()->get();
        return view('backend.content.product.trashed', compact('trashedProducts'));
    }
    public function deletePermanent($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();

        return redirect()->route('produk.terhapus')->with('pesan', ['success', 'Produk berhasil dihapus secara permanen']);
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('produk.terhapus')->with('pesan', ['success', 'Produk berhasil dipulihkan']);
    }
}
