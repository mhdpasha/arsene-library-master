<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use App\Models\Pinjam;

// 'peminjaman' => Buku::all()->take(4),

class DashboardController extends Controller
{
    public function index() {

        $user = auth()->user()->id;

        return view('dashboard', [
            'buku' => Buku::sum('stok'),
            'pinjam' => Pinjam::where('status', 'accepted')->count(),
            'anggota' => User::count(),
            'pustakawan' => User::where('pustakawan', 1)->count(),
            'rekomendasi' => Buku::inRandomOrder()->first(),


            'user' => auth()->user()
        ]);
    }
}
