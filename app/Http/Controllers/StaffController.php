<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::all();
        return view('backend.content.staff.list', compact('staffs'));
    }

    public function tambah()
    {
        return view('backend.content.staff.formTambah');
    }

    public function prosesTambah(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'required|email|unique:staffs,email',
            'tanggung_jawab' => 'nullable|string|max:255',
        ]);

        // Membuat instansi baru dari model Staff
        $staffs = new Staff();
        $staffs->nama = $validatedData['nama'];
        $staffs->jabatan = $validatedData['jabatan'];
        $staffs->email = $validatedData['email'];
        $staffs->tanggung_jawab = $validatedData['tanggung_jawab'];

        try {
            $staffs->save();
            return redirect(route('staff.index'))->with('pesan', ['success','Berhasil tambah staff']);
        } catch (\Exception $e) {
            return redirect(route('staff.index'))->with('pesan', ['danger','Gagal tambah staff']);
        }
    }


    public function ubah($id)
    {
        $staffs = Staff::findOrFail($id);
        return view('backend.content.staff.formUbah', compact('staffs'));
    }

    public function prosesUbah(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'required|email|unique:staffs,email',
            'tanggung_jawab' => 'nullable|string|max:255'
        ]);

        $staffs = Staff::findOrFail($request->id_staff);
        $staffs->nama = $request->nama;
        $staffs->jabatan = $request->jabatan;
        $staffs->email = $request->email;
        $staffs->tanggung_jawab = $request->tanggung_jawab;

        try {
            $staffs->save();
            return redirect(route('staff.index'))->with('pesan', ['success','Berhasil ubah staff']);
        } catch (\Exception $e) {
            return redirect(route('staff.index'))->with('pesan', ['danger','Gagal ubah staff']);
        }
    }


    public function hapus($id)
    {
        $staffs = Staff::findOrFail($id);

        try {
            $staffs->delete();
            return redirect(route('staff.index'))->with('pesan', ['success','Berhasil hapus staff']);
        } catch (\Exception $e) {
            return redirect(route('staff.index'))->with('pesan', ['danger','Gagal hapus staff']);
        }
    }
}
