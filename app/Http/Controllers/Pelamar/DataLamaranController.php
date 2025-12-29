<?php

namespace App\Http\Controllers\Pelamar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Informasi;
use App\Models\Sertifikat;
use App\Models\DetailUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDF;

class DataLamaranController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $id_users = Auth::user()->id;
        $data = [
            'title' => "Data Lamaran Magang",
            'data_lamaran' => Pendaftaran::leftJoin('lowongan', 'pendaftaran.id_lowongan', '=', 'lowongan.id')
                                ->join('users', 'pendaftaran.id_users', '=', 'users.id')
                                ->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')
                                ->where('pendaftaran.id_users', $id_users)
                                ->select('pendaftaran.*', 'lowongan.nama_lowongan', 'detail_users.nama_lengkap')
                                ->orderBy('pendaftaran.created_at', 'DESC')
                                ->get(),
        ];

        return view('pelamar/datalamaran')->with('data', $data);
    }

    public function detail($id_pendaftaran)
    {
        $data = [
            'title' => "Detail Status Lamaran",
            'detail_pendaftaran' => Pendaftaran::leftJoin('lowongan', 'pendaftaran.id_lowongan', '=', 'lowongan.id')
                                ->join('users', 'pendaftaran.id_users', '=', 'users.id')
                                ->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')
                                ->where('id_pendaftaran', $id_pendaftaran)
                                ->select('pendaftaran.*', 'users.email', 'detail_users.*', 'lowongan.nama_lowongan', 'lowongan.pertanyaan_wawancara', 'lowongan.tugas_project', 'lowongan.file_tugas')
                                ->first(),
        ];

        return view('pelamar/detaillamaran')->with('data', $data);
    }


    public function detail_informasi($id_informasi){
        $data = [
            'title' => "Detail Informasi ",
            'informasi' => Informasi::where('id_informasi', $id_informasi)->first(),
        ];

        return view('pelamar/detailinformasi')->with('data', $data);
    }

    public function cetak($id_pendaftaran){
        $data = [
            'title' => "Surat Bukti Lolos",
            'detail_pendaftaran' => Pendaftaran::leftJoin('lowongan', 'pendaftaran.id_lowongan', '=', 'lowongan.id')
                                ->join('users', 'pendaftaran.id_users', '=', 'users.id')
                                ->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')
                                ->where('id_pendaftaran', $id_pendaftaran)
                                ->select('pendaftaran.*', 'users.email', 'detail_users.*', 'lowongan.nama_lowongan')
                                ->first(),
        ];


        $pdf = PDF::loadview('pelamar/cetaklamaran', $data);
        //mendownload laporan.pdf
    	return $pdf->stream('laporan.pdf');
    }

    public function submitLinks(Request $request) {
        $request->validate([
            'id_pendaftaran' => 'required|exists:pendaftaran,id_pendaftaran',
            'jawaban_wawancara' => 'required|url',
            'link_project' => 'required|url',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($request->id_pendaftaran);
        
        if ($pendaftaran->id_users != Auth::user()->id) {
            return redirect()->back()->with('err_message', 'Akses Ditolak.');
        }

        $pendaftaran->update([
            'jawaban_wawancara' => $request->jawaban_wawancara,
            'link_project' => $request->link_project,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('suc_message', 'Link tugas dan wawancara telah berhasil disimpan!');
    }
}
