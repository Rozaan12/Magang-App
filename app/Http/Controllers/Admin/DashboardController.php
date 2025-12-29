<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Pendaftaran;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $id_users = Auth::user()->id;
        $data = [
            'title' => "Dashboard Admin",
            'count_lowongan' => \App\Models\Lowongan::where('status', 'aktif')->count(),
            'count_pendaftaran_baru' => Pendaftaran::where('status_pendaftaran', 'menunggu_verifikasi')->count(),
            'count_diterima' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            'count_tidak_diterima' => Pendaftaran::where('status_pendaftaran', 'tidak diterima')->count(),
            'total_pelamar' => User::where('role', 'pelamar')->count()
        ];

        return view('admin/dashboard')->with('data', $data);
    }
}
