<?php

namespace Database\Factories;

use App\Models\Pegawai;
use App\Models\Pekerjaan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * PegawaiFactory - Mirna
 */
class PegawaiFactory extends Factory
{
    protected $model = Pegawai::class;

    protected array $namaMale = [
        'Andi', 'Budi', 'Cahyo', 'Dimas', 'Eko', 'Fajar', 'Galih', 'Hendra',
        'Irfan', 'Joko', 'Kurnia', 'Lukman', 'Mahendra', 'Nugroho', 'Oscar',
        'Prasetyo', 'Rizki', 'Surya', 'Teguh', 'Umar', 'Wahyu', 'Yoga', 'Zainal',
        'Arief', 'Bagas', 'Danang', 'Fauzan', 'Gilang', 'Hafiz', 'Ivan',
        'Kevin', 'Lutfi', 'Naufal', 'Putra', 'Rafi', 'Satria', 'Taufik', 'Wisnu',
        'Agus', 'Bambang', 'Dedi', 'Gunawan', 'Herman', 'Iwan', 'Jaya', 'Krisna',
    ];

    protected array $namaFemale = [
        'Ayu', 'Bunga', 'Citra', 'Dewi', 'Eka', 'Fitri', 'Gita', 'Hana',
        'Indah', 'Julia', 'Kartika', 'Lestari', 'Mega', 'Nadia', 'Oktavia',
        'Putri', 'Ratna', 'Sari', 'Tika', 'Utami', 'Vina', 'Wulan', 'Yuli',
        'Zahra', 'Anisa', 'Bella', 'Dian', 'Fera', 'Gina', 'Hasna', 'Intan',
        'Kirana', 'Laras', 'Nabila', 'Paramita', 'Riska', 'Safira', 'Tiara', 'Widya',
        'Amelia', 'Cantika', 'Dinda', 'Farah', 'Gisela', 'Hesti', 'Ika', 'Jasmine',
    ];

    protected array $namaBelakang = [
        'Pratama', 'Wijaya', 'Kusuma', 'Saputra', 'Hidayat', 'Rahman', 'Putra',
        'Santoso', 'Wibowo', 'Nugraha', 'Permana', 'Setiawan', 'Firmansyah',
        'Ramadhan', 'Maulana', 'Hakim', 'Syahputra', 'Utomo', 'Suryadi', 'Pranata',
        'Harahap', 'Siregar', 'Nasution', 'Lubis', 'Sitorus', 'Pangestu', 'Adiputra',
        'Gunawan', 'Halim', 'Irawan', 'Kurniawan', 'Laksana', 'Mahardika', 'Nusantara',
    ];

    protected array $emailDomains = [
        'gmail.com', 
        'yahoo.co.id', 
        'outlook.com', 
        'company.co.id',
        'mail.com',
    ];

    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $namaDepan = $gender === 'male' 
            ? $this->faker->randomElement($this->namaMale)
            : $this->faker->randomElement($this->namaFemale);
        
        $namaLengkap = $namaDepan . ' ' . $this->faker->randomElement($this->namaBelakang);
        
        $emailPrefix = strtolower(str_replace(' ', '.', $namaLengkap));
        $email = $emailPrefix . $this->faker->unique()->numberBetween(1, 9999) . '@' . $this->faker->randomElement($this->emailDomains);

        // Ambil random pekerjaan_id, jika tidak ada buat baru - Mirna
        $pekerjaan = Pekerjaan::inRandomOrder()->first();
        
        return [
            'pekerjaan_id' => $pekerjaan ? $pekerjaan->id : Pekerjaan::factory(),
            'nama' => $namaLengkap,
            'email' => $email,
            'gender' => $gender,
            'is_active' => $this->faker->boolean(85),
        ];
    }

    /**
     * State: Male
     */
    public function male(): static
    {
        return $this->state(function (array $attributes) {
            $nama = $this->faker->randomElement($this->namaMale) . ' ' . $this->faker->randomElement($this->namaBelakang);
            $emailPrefix = strtolower(str_replace(' ', '.', $nama));
            
            return [
                'gender' => 'male',
                'nama' => $nama,
                'email' => $emailPrefix . $this->faker->unique()->numberBetween(1, 9999) . '@' . $this->faker->randomElement($this->emailDomains),
            ];
        });
    }

    /**
     * State: Female
     */
    public function female(): static
    {
        return $this->state(function (array $attributes) {
            $nama = $this->faker->randomElement($this->namaFemale) . ' ' . $this->faker->randomElement($this->namaBelakang);
            $emailPrefix = strtolower(str_replace(' ', '.', $nama));
            
            return [
                'gender' => 'female',
                'nama' => $nama,
                'email' => $emailPrefix . $this->faker->unique()->numberBetween(1, 9999) . '@' . $this->faker->randomElement($this->emailDomains),
            ];
        });
    }

    /**
     * State: Active
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * State: Inactive
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
