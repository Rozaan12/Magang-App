<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongan';

    protected $fillable = [
        'nama_lowongan',
        'gambar',
        'deskripsi',
        'persyaratan',
        'tahapan_seleksi',
        'kuota',
        'status',
        'pertanyaan_wawancara',
        'tugas_project',
        'minimal_durasi',
        'file_tugas',
        'file_interview',
        'created_by'
    ];
}
