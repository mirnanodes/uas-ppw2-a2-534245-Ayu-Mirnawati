<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * Dashboard dengan Chart Dinamis - Mirna
     */
    public function index()
    {
        // Data untuk Pie Chart - Gender Distribution
        $genderData = Pegawai::select('gender', DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->pluck('total', 'gender')
            ->toArray();

        $maleCount = $genderData['male'] ?? 0;
        $femaleCount = $genderData['female'] ?? 0;

        // Data untuk Bar Chart - Top 5 Pekerjaan dengan Pegawai Terbanyak
        $topPekerjaan = Pekerjaan::withCount('pegawai')
            ->orderByDesc('pegawai_count')
            ->take(5)
            ->get();

        $pekerjaanLabels = $topPekerjaan->pluck('nama')->toArray();
        $pekerjaanData = $topPekerjaan->pluck('pegawai_count')->toArray();

        return view('index', compact(
            'maleCount',
            'femaleCount',
            'pekerjaanLabels',
            'pekerjaanData'
        ));
    }
}
