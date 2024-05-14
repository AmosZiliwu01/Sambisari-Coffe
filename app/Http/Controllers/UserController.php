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
