<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cek Token
        if (empty($user->github_token)) {
            dd("Error: Token GitHub tidak ditemukan di database user.");
        }

        // Request ke GitHub
        $response = Http::withToken($user->github_token)
            ->withoutVerifying() // <--- KUNCI SUKSES DI LOCALHOST (Matikan Cek SSL)
            ->withHeaders(['Accept' => 'application/vnd.github.v3+json'])
            ->get('https://api.github.com/user/repos', [
                'sort'      => 'updated',
                'direction' => 'desc',
                'per_page'  => 12,
                'type'      => 'owner',
            ]);

        // Jika Gagal, JANGAN REDIRECT. Tampilkan errornya di layar.
        if ($response->failed()) {
            dd([
                'Status' => 'Gagal mengambil data dari GitHub',
                'HTTP Code' => $response->status(),
                'Pesan GitHub' => $response->json(),
            ]);
        }

        $repos = $response->json();

        return view('dashboard', [
            'user' => $user,
            'repos' => $repos
        ]);
    }
}