<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class DataPendaftaranController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Pendaftaran Baru",
            'data_pendaftaran' => Pendaftaran::leftJoin('lowongan', 'pendaftaran.id_lowongan', '=', 'lowongan.id')
                                ->join('users', 'pendaftaran.id_users', '=', 'users.id')
                                ->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')
                                ->whereIn('pendaftaran.status_pendaftaran', ['menunggu_verifikasi', 'pengajuan'])
                                ->select('pendaftaran.*', 'users.email', 'detail_users.nama_lengkap', 'users.no_telp', 'lowongan.nama_lowongan')
                                ->get(),
        ];

        return view('admin/datapendaftaran')->with('data', $data);
    }

    public function detail($id_pendaftaran)
    {
        $data = [
            'title' => "Detail Data Pendaftaran",
            'detail_pendaftaran' => Pendaftaran::leftJoin('lowongan', 'pendaftaran.id_lowongan', '=', 'lowongan.id')
                                ->join('users', 'pendaftaran.id_users', '=', 'users.id')
                                ->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')
                                ->where('id_pendaftaran', $id_pendaftaran)
                                ->select('pendaftaran.*', 'users.email', 'detail_users.*', 'lowongan.nama_lowongan')
                                ->first(),
        ];

        return view('admin/detailpendaftaran')->with('data', $data);
    }


    public function diterima(Request $request){

        $id_pendaftaran = $request->id_pendaftaran;

        $data_update = [
            'status_pendaftaran' => 'diterima',
            'keterangan' => $request->keterangan,
        ];

        $pendaftaran = Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->first();

        $id_users = $pendaftaran->id_users;
        $users = User::where('id', $id_users)->first();

        $email = $users->email;
        $data = [
            'title' => 'Selamat Anda diterima Masuk Pada Magang Yang Anda Lamar!',
            'url' => 'http://localhost/aplikasi-magang/public/',
        ];
        try {
            Mail::to($email)->send(new SendMail($data));
        } catch (\Exception $e) {
            // Log error or just continue so app doesn't crash
            \Log::error("Email failed to send to $email: " . $e->getMessage());
        }
        

        Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->update($data_update);

        return redirect('data-pendaftaran')->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function tidak_diterima(Request $request){
        $id_pendaftaran = $request->id_pendaftaran;

        $data_update = [
            'status_pendaftaran' => 'tidak diterima',
            'keterangan' => $request->keterangan,
        ];

        $pendaftaran = Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->first();

        $id_users = $pendaftaran->id_users;
        $users = User::where('id', $id_users)->first();

        $email = $users->email;
        $data = [
            'title' => 'Mohon Maaf Anda Tidak Diterima Masuk Pada Magang Yang Anda Lamar!',
            'url' => 'http://localhost/aplikasi-magang/public/',
        ];

        try {
            Mail::to($email)->send(new SendMail($data));
        } catch (\Exception $e) {
            \Log::error("Email failed to send to $email: " . $e->getMessage());
        }

        Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->update($data_update);

        return redirect('data-pendaftaran')->with('suc_message', 'Data Berhasil diupdate!');
    }

}
