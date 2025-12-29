<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('lowongan')->insert([
            [
                'nama_lowongan' => 'Divisi Teknologi Informasi (Programmer)',
                'gambar' => 'it-programmer.jpg', // Nanti kita sediakan gambar dummy atau biarkan null
                'deskripsi' => 'Bertanggung jawab dalam pengembangan aplikasi web dan mobile perusahaan. Menggunakan teknologi seperti Laravel, Flutter, dan React.',
                'persyaratan' => "- Menguasai PHP (Laravel)\n- Paham konsep MVC\n- Bisa bekerja dengan tim\n- Memiliki laptop sendiri",
                'kuota' => 5,
                'status' => 'aktif',
                'tahapan_seleksi' => 'Administrasi -> Wawancara -> Technical Test',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lowongan' => 'Divisi Marketing (Content Creator)',
                'gambar' => 'marketing.jpg',
                'deskripsi' => 'Membuat konten kreatif untuk media sosial perusahaan (Instagram, TikTok, LinkedIn).',
                'persyaratan' => "- Kreatif dan inovatif\n- Bisa edit video (CapCut/Premiere)\n- Bisa desain grafis (Canva/Photoshop)\n- Aktif di media sosial",
                'kuota' => 3,
                'status' => 'aktif',
                'tahapan_seleksi' => 'Administrasi -> Portofolio Review -> Wawancara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lowongan' => 'Divisi HR (Recruitment Staff)',
                'gambar' => 'hrd.jpg',
                'deskripsi' => 'Membantu proses rekrutmen karyawan dan magang baru, serta administrasi kepegawaian.',
                'persyaratan' => "- Mahasiswa Psikiologi/Hukum/Manajemen\n- Teliti dan rapi\n- Memiliki kemampuan komunikasi yang baik",
                'kuota' => 2,
                'status' => 'aktif',
                'tahapan_seleksi' => 'Administrasi -> Wawancara User',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
