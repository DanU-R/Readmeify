<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // 1. Arahkan user ke GitHub untuk login
    public function redirect()
    {
        // Scope 'repo' penting agar kita bisa commit file README nanti
        return Socialite::driver('github')
            ->scopes(['read:user', 'repo']) 
            ->redirect();
    }

    // 2. Handle balikan dari GitHub
    public function callback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();

            $user = User::updateOrCreate(
                ['github_id' => $githubUser->id],
                [
                    'name' => $githubUser->name ?? $githubUser->nickname,
                    'email' => $githubUser->email,
                    'github_token' => $githubUser->token, // Token disimpan saat login
                    'github_refresh_token' => $githubUser->refreshToken,
                    'password' => bcrypt('password-dummy') // Dummy pass karena login via GitHub
                ]
            );

            // Login user ke dalam sesi Laravel
            Auth::login($user);

            // Langsung arahkan ke Dashboard (Debug dihapus agar mulus)
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Login Gagal: ' . $e->getMessage());
        }
    }
    
    // 3. Logout (DENGAN FITUR KEAMANAN HAPUS TOKEN)
    public function logout(Request $request) {
        
        // A. Ambil user yang sedang login
        $user = Auth::user();

        // B. Hapus Token GitHub di Database (Security Feature)
        if ($user) {
            $user->github_token = null;
            $user->save();
        }

        // C. Logout dari Sesi Laravel
        Auth::logout();

        // D. Hapus data sesi browser & regenerasi CSRF (Best Practice)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // E. Kembali ke Halaman Utama dengan pesan
        return redirect('/')->with('success', 'Anda berhasil logout. Token akses telah dihapus demi keamanan.');
    }
}