<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DataLowonganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Lowongan Magang",
            'data_lowongan' => Lowongan::get(),
        ];

        return view('admin/datalowongan')->with('data', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'nama_lowongan' => 'required',
            'kuota' => 'required|numeric',
            'minimal_durasi' => 'required|numeric|min:1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_tugas' => 'nullable|file|mimes:pdf|max:10240',
            'file_interview' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $nama_document_gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_document_gambar = time()."_".$gambar->getClientOriginalName();
            $tujuan_upload = 'uploads/lowongan';
            $gambar->move($tujuan_upload, $nama_document_gambar);
        }

        $nama_file_tugas = null;
        if ($request->hasFile('file_tugas')) {
            $file = $request->file('file_tugas');
            $nama_file_tugas = "Task_".time()."_".$file->getClientOriginalName();
            $file->move('uploads/file_tugas', $nama_file_tugas);
        }

        $nama_file_interview = null;
        if ($request->hasFile('file_interview')) {
            $file = $request->file('file_interview');
            $nama_file_interview = "Interview_".time()."_".$file->getClientOriginalName();
            $file->move('uploads/file_interview', $nama_file_interview);
        }

        $data = [
            'nama_lowongan' => $request->nama_lowongan,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'tahapan_seleksi' => $request->tahapan_seleksi,
            'kuota' => $request->kuota,
            'status' => $request->status,
            'pertanyaan_wawancara' => $request->pertanyaan_wawancara,
            'tugas_project' => $request->tugas_project,
            'minimal_durasi' => $request->minimal_durasi,
            'file_tugas' => $nama_file_tugas,
            'file_interview' => $nama_file_interview,
            'gambar' => $nama_document_gambar,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ];

        Lowongan::create($data);

        return redirect()->back()->with('suc_message', 'Data Lowongan Berhasil disimpan!');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $lowongan = Lowongan::findOrFail($id);

        $request->validate([
            'nama_lowongan' => 'required',
            'minimal_durasi' => 'required|numeric|min:1',
            'kuota' => 'required|numeric',
        ]);

        $data = [
            'nama_lowongan' => $request->nama_lowongan,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'tahapan_seleksi' => $request->tahapan_seleksi,
            'kuota' => $request->kuota,
            'status' => $request->status,
            'pertanyaan_wawancara' => $request->pertanyaan_wawancara,
            'tugas_project' => $request->tugas_project,
            'minimal_durasi' => $request->minimal_durasi,
            'updated_at' => Carbon::now(),
        ];

        if ($request->hasFile('gambar')) {
            $request->validate(['gambar' => 'image|mimes:jpeg,png,jpg|max:2048']);
            $gambar = $request->file('gambar');
            $nama_document_gambar = time()."_".$gambar->getClientOriginalName();
            $tujuan_upload = 'uploads/lowongan';
            $gambar->move($tujuan_upload, $nama_document_gambar);
            $data['gambar'] = $nama_document_gambar;
        }

        if ($request->hasFile('file_tugas')) {
            $request->validate(['file_tugas' => 'file|mimes:pdf|max:10240']);
            $file = $request->file('file_tugas');
            $nama_file_tugas = "Task_".time()."_".$file->getClientOriginalName();
            $file->move('uploads/file_tugas', $nama_file_tugas);
            $data['file_tugas'] = $nama_file_tugas;
        }

        if ($request->hasFile('file_interview')) {
            $request->validate(['file_interview' => 'file|mimes:pdf|max:10240']);
            $file = $request->file('file_interview');
            $nama_file_interview = "Interview_".time()."_".$file->getClientOriginalName();
            $file->move('uploads/file_interview', $nama_file_interview);
            $data['file_interview'] = $nama_file_interview;
        }

        $lowongan->update($data);

        return redirect()->back()->with('suc_message', 'Data Lowongan Berhasil diupdate!');
    }

    public function delete($id)
    {
        Lowongan::where('id', $id)->delete();
        return redirect()->back()->with('suc_message', 'Data Lowongan Berhasil Dihapus!');
    }
}
