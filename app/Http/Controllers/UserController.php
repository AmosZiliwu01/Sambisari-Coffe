<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index(){
        $user = User::all();
        return view('backend.content.user.list', compact('user'));

    }
    public function updateProfile(){
        return view('backend.content.profile');
    }

    public function prosesUpdateProfile(Request $request)
    {
        $id = $request->user()->id;
        $user = User::findOrFail($id);

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            ]);

            $user->name = $request->input('name');
            $user->email = $request->input('email');

            try {
                $user->save();

                // Redirect based on user's role
                if ($user->role === 'admin') {
                    return redirect()->route('dashboard.index')->with('pesan', ['success', 'Profile updated successfully']);
                } elseif ($user->role === 'kasir') {
                    return redirect()->route('kategori.index')->with('pesan', ['success', 'Profile updated successfully']);
                } elseif ($user->role === 'pelanggan') {
                    return redirect()->route('pesanan.index')->with('pesan', ['success', 'Profile updated successfully']);
                } else {
                    // Redirect to a default route if the role is not recognized
                    return redirect()->route('dashboard.index')->with('pesan', ['warning', 'Unknown role']);
                }
            } catch (\Exception $e) {
                return redirect()->route('dashboard.index')->with('pesan', ['danger', 'Failed to update profile']);
            }
        }

        return view('backend.content.profile', compact('user'));
    }



    public function hapus($id){
        $user = User::findOrFail($id);

        try{
            $user->delete();
            return redirect(route('user.index'))->with('pesan',['success','Berhasil hapus user']);
        }catch (\Exception $e){
            return redirect(route('user.index'))->with('pesan',['danger','Gagal hapus user']);
        }
    }
}
