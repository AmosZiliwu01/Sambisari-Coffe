<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promosi;
use Illuminate\Http\Request;

class PromosiController extends Controller
{
    public function index()
    {
        $promosi = Promosi::all();
        return view('backend.content.promosi.list', compact('promosi'));
    }

    public function tambah()
    {
        $product = Product::all();
        return view('backend.content.promosi.formTambah', compact('product'));
    }

    public function prosesTambah(Request $request)
    {
        $this->validate($request, [
            'judul_promosi' => 'required',
            'deskripsi' => 'required',
            'image_promosi' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount_price' => 'required',
            'active_status' => 'required',
            'product_id' => 'required',
        ]);

        $image_promosi = null;
        if ($request->hasFile('image_promosi')) {
            $image_promosi = $request->file('image_promosi')->store('public');
        }

        try {
            Promosi::create([
                'judul_promosi' => $request->judul_promosi,
                'deskripsi' => $request->deskripsi,
                'image_promosi' => $image_promosi,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'discount_price' => $request->discount_price,
                'active_status' => $request->active_status,
                'product_id' => $request->product_id,
            ]);
            return redirect(route('promosi.index'))->with('pesan', ['Success', 'Berhasil tambah promosi']);
        } catch (\Exception $e) {
            return redirect(route('promosi.index'))->with('pesan', ['danger', 'Gagal tambah promosi']);
        }
    }

    public function ubah($id)
    {
        $promosi = Promosi::findOrFail($id);
        $product = Product::all();
        return view('backend.content.promosi.formUbah', compact('promosi', 'product'));
    }

    public function prosesUbah(Request $request)
    {
        $this->validate($request, [
            'judul_promosi' => 'required',
            'deskripsi' => 'required',
            'image_promosi' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount_price' => 'required',
            'active_status' => 'required',
            'id' => 'required',
        ]);

        $promosi = Promosi::findOrFail($request->id_promosi);
        $promosi->judul_promosi = $request->judul_promosi;
        $promosi->deskripsi = $request->deskripsi;
        $promosi->image_promosi = $request->image_promosi;
        $promosi->start_date = $request->start_date;
        $promosi->end_date = $request->end_date;
        $promosi->discount_price = $request->discount_price;
        $promosi->active_status = $request->active_status;
        $promosi->product_id = $request->product_id;


        if ($request->hasFile('image_promosi')) {
            $request->file('image_promosi')->store('public');
            $image_promosi = $request->file('image_promosi')->hashName();
            $promosi->image_promosi = $image_promosi;
        }
        try {
            $promosi->save();
            return redirect(route('promosi.index'))->with('pesan', ['Success', 'berhasil ubah promosi']);
        } catch (\Exception $e) {
            return redirect(route('promosi.index'))->with('pesan', ['danger', 'Gagal ubah promosi']);
        }
    }

    public function hapus($id)
    {
        $promosi = Promosi::findOrFail($id);
        try {
            $promosi->delete();
            return redirect(route('promosi.index'))->with('pesan', ['Success', 'berhasil hapus promosi']);
        } catch (\Exception $e) {
            return redirect(route('promosi.index'))->with('pesan', ['danger', 'Gagal hapus promosi']);
        }
    }
}
