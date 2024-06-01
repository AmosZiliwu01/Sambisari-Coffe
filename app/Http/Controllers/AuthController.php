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

            // Check if the user is active
            if (!$user->is_active) {
                Auth::guard('user')->logout();
                return redirect()->route('auth.index')->with('pesan', ['danger', 'Akun belum diaktivasi. Silakan cek email Anda untuk aktivasi akun.']);
            }

            if ($user->role == 'pelanggan') {
                return redirect()->route('pesanan.index');
            } elseif ($user->role == 'kasir') {
                return redirect()->route('kategori.index');
            } else {
                return redirect()->route('dashboard.index');
            }
        } else {
            return redirect()->route('auth.index')->with('pesan', ['danger', 'Kombinasi Email dan Password salah']);
        }
    }

    public function register()
    {
        return view('backend.content.register.index');
    }

    public function registerProceed(Request $request)
    {
        // Validation rules and custom error messages
        $messages = [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email harus valid.',
            'password.required' => 'Password tidak boleh kosong.',
        ];

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        // Check if email already exists
        $user = User::query()->where('email', $request->email)->first();
        if ($user !== null) {
            return back()->with('pesan', ['danger', 'Email sudah terdaftar.']);
        }

        // Create new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_active = 0; // User is not active initially
        $user->token_activation = md5($request->email . date('Y-m-dH:i:s'));
        $user->save();

        // Send activation email
        Mail::to($user->email)->queue(new RegisterMail($user));
        return redirect('/login')->with('pesan', ['success', 'Registrasi Berhasil, cek email anda untuk aktivasi']);
    }

    public function registerVerify($token)
    {
        $user = User::query()->where('token_activation', $token)->first();
        if ($user === null) {
            return redirect('/login')->with('pesan', ['danger', 'Token tidak ditemukan']);
        }
        $user->token_activation = null;
        $user->is_active = 1;
        $user->save();
        return redirect('/login')->with('pesan', ['success', 'Aktivasi Berhasil, anda sudah bisa login']);
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('auth.index');
    }

    public function forgotpassword()
    {
        return view('auth.forgotPassword');
    }

    public function resetPasswordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }

    public function showResetPasswordForm($token, Request $request)
    {
        $email = $request->email;
        return view('auth.reset_password_confirmation', ['token' => $token, 'email' => $email]);
    }

    public function updatePassword(Request $request, $token)
    {
        $user = User::where('email', $token)->first();

        if (!$user) {
            return redirect()->route('auth.index')->with('pesan', ['danger', 'Token tidak valid.']);
        }

        $request->validate([
            'new_password' => 'required|min:6',
            'c_new_password' => 'required_with:new_password|same:new_password|min:6',
        ]);

        $user->password = Hash::make($request->new_password);
        $user->remember_token = null;
        $user->save();

        return redirect()->route('auth.index')->with('status', __('Your password has been reset successfully.'));
    }
}
