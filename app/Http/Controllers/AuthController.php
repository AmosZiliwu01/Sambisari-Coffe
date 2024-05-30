<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPasswordEmail;
use function Termwind\style;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('user')->user();
            if ($user->role == 'pelanggan') {
                return redirect()->route('pesanan.index');
            } elseif ($user->role == 'kasir') {
                return redirect()->route('kategori.index');
            } else {
                return redirect()->route('dashboard.index');
            }
        } else {
            return redirect()->route('auth.index')->with('pesan', ['danger','Kombinasi Email dan Password salah']);
        }
    }

    public function register()
    {
        return view('backend.content.register.index');
    }

    public function registerProceed(Request $request)
    {
        #tugas buat validasi

        #kondisi semua data ada
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $user = User::query()->where('email', $email)->first();
        if ($user !== null) {
            #email sudah digunakan, tidak boleh mendaftar lagi
            return back()->with('pesan', ['danger','Email sudah terdaftar.']);
        }
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->is_active = 0;
        $user->token_activation = md5($email . date('Y-m-dH:i:s'));
        $user->save();
        #kirim email.
        Mail::to($user->email)->queue(new RegisterMail($user));
        return redirect('/login')->with('pesan', ['success','Registrasi Berhasil, cek email anda untuk aktivasi']);
    }

    public function registerVerify($token)
    {
        #get user by token
        $user = User::query()->where('token_activation', $token)->first();
        if ($user === null) {
            return redirect('/login')->with('pesan', ['danger','Token tidak ditemukan']);
        }
        #user ada
        $user->token_activation = null;
        $user->is_active = 1;
        $user->save();
        return redirect('/login')->with('pesan', ['success','Aktivasi Berhasil, anda sudah bisa login']);
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('home.index');
    }

    public function forgotpassword()
    {
        return view('auth.forgotPassword');
    }

    public function resetPasswordEmail(Request $request)
    {
        // Validasi input email
        $request->validate(['email' => 'required|email']);

        // Kirim email reset password
        $status = Password::sendResetLink($request->only('email'));

        // Periksa status pengiriman email
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }

    // Metode untuk menampilkan formulir reset password
    public function showResetPasswordForm($token, Request $request)
    {

        $email = $request->email;
        return view('auth.reset_password_confirmation', ['token' => $token, 'email' => $email]);
    }

    // Metode untuk memperbarui password
    public function updatePassword(Request $request, $token)
    {
        // Cari pengguna berdasarkan token
        $user = User::where('email', $token)->first();

        // Periksa apakah pengguna ditemukan berdasarkan token
        if (!$user) {
            return redirect()->route('auth.index')->with('pesan', ['danger', 'Token tidak valid.']);
        }

        // Validasi input
        $request->validate([
            'new_password' => 'required|min:6',
            'c_new_password' => 'required_with:new_password|same:new_password|min:6',
        ]);

        // Perbarui password pengguna
        $user->password = Hash::make($request->new_password);
        $user->remember_token = null; // Hapus token reset password setelah pengguna memperbarui kata sandi
        $user->save();

        // Redirect pengguna ke halaman login dengan pesan sukses
        return redirect()->route('auth.index')->with('status', __('Your password has been reset successfully.'));
    }

}
