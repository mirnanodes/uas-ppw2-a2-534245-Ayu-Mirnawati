<?php

namespace Database\Factories;

use App\Models\Pekerjaan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * PekerjaanFactory - Mirna
 */
class PekerjaanFactory extends Factory
{
    protected $model = Pekerjaan::class;

    protected static array $jobs = [
        ['nama' => 'Software Engineer', 'deskripsi' => 'Mengembangkan dan memelihara aplikasi software sesuai kebutuhan bisnis'],
        ['nama' => 'Data Analyst', 'deskripsi' => 'Menganalisis data untuk menghasilkan insight dan mendukung pengambilan keputusan'],
        ['nama' => 'Project Manager', 'deskripsi' => 'Mengelola proyek dari perencanaan hingga implementasi'],
        ['nama' => 'System Administrator', 'deskripsi' => 'Mengelola dan memelihara infrastruktur sistem IT'],
        ['nama' => 'UI/UX Designer', 'deskripsi' => 'Merancang antarmuka dan pengalaman pengguna yang optimal'],
        ['nama' => 'Web Developer', 'deskripsi' => 'Membangun dan mengembangkan aplikasi berbasis web'],
        ['nama' => 'Mobile App Developer', 'deskripsi' => 'Mengembangkan aplikasi mobile untuk platform Android dan iOS'],
        ['nama' => 'Database Administrator', 'deskripsi' => 'Mengelola dan mengoptimalkan database perusahaan'],
        ['nama' => 'Network Engineer', 'deskripsi' => 'Merancang dan memelihara infrastruktur jaringan'],
        ['nama' => 'IT Support Specialist', 'deskripsi' => 'Memberikan dukungan teknis untuk pengguna dan sistem IT'],
        ['nama' => 'Quality Assurance Engineer', 'deskripsi' => 'Memastikan kualitas software melalui testing dan validasi'],
        ['nama' => 'Business Analyst', 'deskripsi' => 'Menganalisis kebutuhan bisnis dan menerjemahkan ke solusi teknis'],
        ['nama' => 'Product Manager', 'deskripsi' => 'Mengelola pengembangan produk dari konsep hingga peluncuran'],
        ['nama' => 'DevOps Engineer', 'deskripsi' => 'Mengintegrasikan development dan operations untuk deployment yang efisien'],
        ['nama' => 'Cyber Security Analyst', 'deskripsi' => 'Melindungi sistem dan data dari ancaman keamanan siber'],
        ['nama' => 'Technical Writer', 'deskripsi' => 'Membuat dokumentasi teknis yang jelas dan komprehensif'],
        ['nama' => 'Cloud Engineer', 'deskripsi' => 'Merancang dan mengelola infrastruktur cloud'],
        ['nama' => 'Backend Developer', 'deskripsi' => 'Mengembangkan server-side logic dan API'],
        ['nama' => 'Frontend Developer', 'deskripsi' => 'Membangun antarmuka pengguna yang responsif dan interaktif'],
        ['nama' => 'Machine Learning Engineer', 'deskripsi' => 'Mengembangkan model machine learning untuk solusi AI'],
    ];

    protected static int $index = 0;

    public function definition(): array
    {
        $job = self::$jobs[self::$index % count(self::$jobs)];
        self::$index++;

        return [
            'nama' => $job['nama'],
            'deskripsi' => $job['deskripsi'],
        ];
    }
}
