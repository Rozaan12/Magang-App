<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\DetailUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class LoginController extends Controller
{
    public function index()
    {

        // dd('test');
        if (Auth::check() and Auth::user()->status != "0") {


            return redirect('home');
        } else {
            // dd('test');
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            return redirect('home');
        } else {
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }

    public function action_login(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $cek_data = User::where('email', $request->email)->count();

        if ($cek_data > 0) {
            $data_user = User::where('email', $request->email)->first();
            if ($data_user->status != '0') {
                if (Auth::attempt($data)) {
                    $request->session()->regenerate();

                    if (Auth::user()->role == 'admin') {
                        $id_users =  Auth::user()->id;
                        $cek_data = User::where('id', $id_users)->count();


                        if ($cek_data > 0) {

                            if (Auth::user()->role == '0') {
                                Auth::logout();
                                $request->session()->invalidate();
                                $request->session()->regenerateToken();
                                return redirect()->back()->with('err_message', 'Akun Dinonaktfikan  !!');
                                return redirect('login');
                            } else {

                                return redirect('dashboard');
                            }
                        } else {
                            return redirect('lengkapi-profile');
                        }
                    } else {


                        if (Auth::user()->status == "0") {

                            return redirect('login')->with('err_message', 'Akun Belum di Verifikasi  !!');
                        } else {
                            return redirect('');
                        }
                    }
                } else {

                    return redirect()->back()->with('err_message', 'Email dan Password Salah !!');
                }
            } else {
                return redirect('login')->with('err_message', 'Akun Belum di Verifikasi  !!');
            }
        } else {
            return redirect()->back()->with('err_message', 'Email dan Password Salah !!');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('login');
    }

    public function register()
    {

        return view('auth.register');
    }

    public function insert_register(Request $request)
    {
        // Validasi input lengkap
        $request->validate([
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat_lengkap' => 'required',
            'sekolah' => 'required',
            'jurusan' => 'required',
            'email' => 'required|email|unique:users,email',
            'no_telp' => 'required',
            'password' => 'required|min:6',
            'cv' => 'required|mimes:pdf|max:10240', // Max 10MB
            'portofolio_file' => 'nullable|mimes:pdf|max:10240', // Max 10MB
            'username_telegram' => 'required',
        ]);

        try {
            \DB::beginTransaction();

            // Upload CV
            $cvName = null;
            if ($request->hasFile('cv')) {
                $file = $request->file('cv');
                $cvName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('berkas'), $cvName);
            }

            // Upload Portofolio File (Optional)
            $portoName = null;
            if ($request->hasFile('portofolio_file')) {
                $file = $request->file('portofolio_file');
                $portoName = time() . '_porto_' . $file->getClientOriginalName();
                $file->move(public_path('berkas'), $portoName);
            }

            $data = [
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat_lengkap,
                'status' => '1',
                'password' => Hash::make($request->password),
                'role' => 'pelamar',
                'created_at' => Carbon::now(),
            ];

            $user = User::create($data);
            $lastId = $user->id;

            $data_detail = [
                'id_users' => $lastId,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat_lengkap' => $request->alamat_lengkap,
                'sekolah' => $request->sekolah,
                'jurusan' => $request->jurusan,
                'program_studi' => $request->program_studi,
                'cv' => $cvName,
                'portofolio_file' => $portoName,
                'portofolio_link' => $request->portofolio_link,
                'username_telegram' => $request->username_telegram,
                'jenis_kelamin' => '-', 
                'agama' => '-',
                'nim' => '-',
                'nik' => '-',
                'created_at' => Carbon::now(),
            ];

            DetailUsers::insert($data_detail);

            \DB::commit();
            
            return redirect('login')->with('suc_message', 'Registrasi Berhasil! Silakan Login.');
            
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()->withInput()->with('err_message', 'Terjadi Kesalahan: ' . $e->getMessage());
        }
    }

    public function lengkapi_profile()
    {

        return view('auth.lengkapiprofile');
    }


    public function profile()
    {
        $data = [
            'profile' => User::join('detail_users', 'detail_users.id_users', '=', 'users.id')->where('id', Auth::user()->id)->first(),
        ];

        return view('auth.profile')->with('data', $data);
    }


    public function insert_lengkapi_profile(Request $request)
    {

        $data = [
            'nim' => $request->nim,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat_lengkap' => $request->alamat_lengkap,
            'nama_lengkap' => $request->nama_lengkap,
            'id_users' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ];

        DetailUsers::insert($data);

        $update = [
            'status' => '1'
        ];
        User::where('id', Auth::user()->id)->update($update);

        return redirect('')->with('suc_message', 'Data Berkas Lengkap!');

        // return redirect()->route('login');
    }

    public function verifikasi($id)
    {
        $update = [
            'status' => '1'
        ];
        User::where('id', $id)->update($update);

        return redirect('home')->with('suc_message', 'Data Berhasil Diverifikasi!');;
    }

    public function update_profile(Request $request)
    {
        $id_users = Auth::user()->id;

        try {
            // Data untuk tabel detail_users
            $data_detail = [
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat_lengkap' => $request->alamat_lengkap,
                'sekolah' => $request->sekolah,
                'jurusan' => $request->jurusan,
                'program_studi' => $request->program_studi,
                'portofolio_link' => $request->portofolio_link,
                'username_telegram' => $request->username_telegram,
            ];

            // Cek Upload File CV Baru
            if ($request->hasFile('cv')) {
                $request->validate(['cv' => 'mimes:pdf|max:10240']);
                $file = $request->file('cv');
                $cvName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('berkas'), $cvName);
                
                // Tambahkan ke array update
                $data_detail['cv'] = $cvName;
                
                // TODO: Hapus file lama jika ada (optional enhancement)
            }

            // Cek Upload File Portofolio Baru
            if ($request->hasFile('portofolio_file')) {
                 $request->validate(['portofolio_file' => 'mimes:pdf|max:10240']);
                $file = $request->file('portofolio_file');
                $portoName = time() . '_porto_' . $file->getClientOriginalName();
                $file->move(public_path('berkas'), $portoName);
                
                $data_detail['portofolio_file'] = $portoName;
            }

            DetailUsers::where('id_users', $id_users)->update($data_detail);

            // Data untuk tabel User (Akun)
            $data_users = [
                'name' => $request->nama_lengkap, // Sync nama di user table
                'email' => $request->email,
                'no_telp' => $request->no_telp,
            ];

            // Cek Ganti Password (Hanya jika diisi)
            if ($request->filled('password')) {
                $data_users['password'] = Hash::make($request->password);
            }

            User::where('id', $id_users)->update($data_users);

            return redirect()->back()->with('suc_message', 'Profil berhasil diperbarui!');
            
        } catch (\Exception $e) {
             return redirect()->back()->with('err_message', 'Gagal update profil: ' . $e->getMessage());
        }
    }
}
