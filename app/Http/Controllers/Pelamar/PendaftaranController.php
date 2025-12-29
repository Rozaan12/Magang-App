<?php

namespace App\Http\Controllers\Pelamar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\DetailUsers;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class PendaftaranController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $id_users = Auth::user()->id;
        
        // Cek apakah user sudah punya lamaran aktif (Pending/Diterima)
        // Kita batasi 1 user max 1 lamaran aktif biar gak spam
        $lamaran_aktif = Pendaftaran::where('id_users', $id_users)
                        ->whereIn('status_pendaftaran', ['pending', 'wawancara', 'diterima', 'menunggu_verifikasi']) // Sesuaikan status enum nanti
                        ->first();

        $data = [
            'title' => "Lowongan Magang Tersedia",
            'lowongan' => \App\Models\Lowongan::where('status', 'aktif')->get(),
            'lamaran_aktif' => $lamaran_aktif,
            'users' => DetailUsers::where('id_users', $id_users)->first(),
        ];

        return view('pelamar/pendaftaran_list')->with('data', $data); // Ganti view ke pendaftaran_list (card view)
    }

    public function detail_lowongan($id)
    {
        $lowongan = \App\Models\Lowongan::findOrFail($id);
        $data = [
            'title' => "Detail Lowongan - " . $lowongan->nama_lowongan,
            'lowongan' => $lowongan,
        ];
        return view('pelamar/detail_lowongan')->with('data', $data);
    }

    public function insert(Request $request){
        $id_users = Auth::user()->id;
        
        $request->validate([
            'id_lowongan' => 'required|exists:lowongan,id',
            'dari_tanggal' => 'required|date|after_or_equal:today',
            'sampai_tanggal' => 'required|date|after:dari_tanggal',
            'surat_rekomendasi' => 'required|file|mimes:pdf|max:5120', // Max 5MB
        ]);

        $lowongan = \App\Models\Lowongan::findOrFail($request->id_lowongan);

        // Backend Duration Check
        $start = Carbon::parse($request->dari_tanggal);
        $end = Carbon::parse($request->sampai_tanggal);
        
        // Menghitung bulan secara konservatif (30 hari = 1 bulan)
        $diffDays = $start->diffInDays($end);
        $actualMonths = $diffDays / 30;

        if($actualMonths < $lowongan->minimal_durasi) {
            return redirect()->back()->with('err_message', 'Periode magang minimal adalah ' . $lowongan->minimal_durasi . ' bulan. Mohon sesuaikan tanggal seleksi Anda.');
        }

        // Cek Double Application
        $cek = Pendaftaran::where('id_users', $id_users)
                ->whereIn('status_pendaftaran', ['menunggu_verifikasi', 'wawancara', 'diterima', 'pending'])
                ->count();
                
        if($cek > 0){
             return redirect('data-lamaran')->with('err_message', 'Anda masih memiliki lamaran yang sedang diproses.');
        }

        // Handle File Rekomendasi
        $nama_file_rekom = null;
        if ($request->hasFile('surat_rekomendasi')) {
            $file = $request->file('surat_rekomendasi');
            $nama_file_rekom = "Rekom_".time()."_".$file->getClientOriginalName();
            $file->move('uploads/berkas_magang', $nama_file_rekom);
        }

        // Simpan Lamaran
        $data = [
            'id_users' => $id_users,
            'id_lowongan' => $request->id_lowongan,
            'dari_tanggal' => $request->dari_tanggal,
            'sampai_tanggal' => $request->sampai_tanggal,
            'surat_rekomendasi' => $nama_file_rekom,
            'status_pendaftaran' => 'menunggu_verifikasi',
            'created_at' => Carbon::now(),
            'keterangan' => 'Melamar via Website',
            'universitas' => '-',
            'prodi' => '-',
            'jurusan' => '-',
            'gambar' => '-',
            'ktp' => '-',
            'cv' => '-',
            'proposal' => '-',
        ];

        Pendaftaran::insert($data);

        return redirect('data-lamaran')->with('suc_message', 'Lamaran berhasil dikirim! Silakan pantau status seleksi secara berkala.');
    }

    

}
