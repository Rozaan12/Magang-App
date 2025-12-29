<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $primaryKey = 'id_pendaftaran';
    protected $fillable = [
        'id_pendaftaran',
        'gambar',
        'ktp',
        'prodi',
        'jurusan',
        'surat_rekomendasi',
        'cv',
        'proposal',
        'id_users',
        'universitas',
        'dari_tanggal',
        'sampai_tanggal',
        'keterangan',
        'id_lowongan', // New
        'jawaban_wawancara', // New
        'link_project', // New
        'status_pendaftaran', // Pastikan ini ada jika dipakai
        'created_at',
        'updated_at'
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan');
    }
}
