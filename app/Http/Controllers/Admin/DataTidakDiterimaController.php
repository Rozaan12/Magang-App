<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class DataTidakDiterimaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Pelamar Ditolak",
            'data_pendaftaran' => Pendaftaran::leftJoin('lowongan', 'pendaftaran.id_lowongan', '=', 'lowongan.id')
                                ->join('users', 'pendaftaran.id_users', '=', 'users.id')
                                ->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')
                                ->where('status_pendaftaran', 'tidak diterima')
                                ->select('pendaftaran.*', 'users.email', 'detail_users.nama_lengkap', 'users.no_telp', 'lowongan.nama_lowongan')
                                ->get(),
        ];

        return view('admin/datatidakditerima')->with('data', $data);
    }

    public function detail($id_pendaftaran)
    {
        $data = [
            'title' => "Detail Pelamar Ditolak",
            'detail_pendaftaran' => Pendaftaran::leftJoin('lowongan', 'pendaftaran.id_lowongan', '=', 'lowongan.id')
                                ->join('users', 'pendaftaran.id_users', '=', 'users.id')
                                ->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')
                                ->where('id_pendaftaran', $id_pendaftaran)
                                ->select('pendaftaran.*', 'users.email', 'users.no_telp', 'detail_users.*', 'lowongan.nama_lowongan')
                                ->first(),
        ];

        return view('admin/detailpendaftaran')->with('data', $data);
    }

}
