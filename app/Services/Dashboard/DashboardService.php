<?php

namespace App\Services\Dashboard;

use App\Models\Arsip;
use App\Models\Pemohon;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Services\Dashboard\DashboardServiceInterface;

class DashboardService implements DashboardServiceInterface
{
    private array $jenisPengurusanPemohon = [
        'KTP baru', 'Rusak', 'Hilang', 'Lainya'
    ];

    /**
     * Fungsi kueri Anda yang sudah sangat efisien.
     * Kita akan panggil ini dari fungsi endpoint kita.
     */
    private function getLokasiArsipCount (): array
    {
        $tipeLokasi = ['ruangan', 'lemari', 'rak', 'laci', 'box'];
        $selects = collect($tipeLokasi)
            ->map(fn($tipe) => DB::raw("COUNT({$tipe}) as {$tipe}"))
            ->all();

        $counts = Arsip::query()
            ->select($selects)
            ->first();

        return $counts ? $counts->toArray() : array_fill_keys($tipeLokasi, 0);
    }

    /**
     * FUNGSI BARU: Endpoint untuk menyediakan data ke chart.
     */
    protected function getLokasiArsipForChart()
    {
        // 1. Panggil fungsi Anda untuk mendapatkan data hitungan mentah
        $counts = $this->getLokasiArsipCount(); // Hasil: ['ruangan' => 520, 'lemari' => 480, ...]

        // 2. Tentukan label dan urutan yang kita inginkan untuk chart
        // Ini memastikan urutan selalu konsisten dan labelnya rapi (dengan huruf kapital).
        $categories = ['Ruangan', 'Lemari', 'Rak', 'Laci', 'Box'];

        $seriesData = [];
        foreach ($categories as $category) {
            // Ubah 'Ruangan' menjadi 'ruangan' agar cocok dengan kunci dari hasil query
            $key = strtolower($category);

            // Masukkan data ke array series, jika tidak ada, beri nilai 0
            $seriesData[] = $counts[$key] ?? 0;
        }

        // 3. Kembalikan dalam format JSON yang siap digunakan frontend
        return [
            'categories' => $categories,
            'seriesData' => $seriesData,
        ];
    }

    /**
     * Fungsi asli Anda untuk menghitung data.
     * Kita akan panggil fungsi ini dari fungsi chart kita.
     */
    private function getJenisPengurusanPemohonCount() : array
    {
        $jenisPengurusan = $this->jenisPengurusanPemohon;

        $counts = Pemohon::query()
            ->whereIn('jenis_pengurusan', $jenisPengurusan)
            ->select('jenis_pengurusan', DB::raw('count(*) as total'))
            ->groupBy('jenis_pengurusan')
            ->pluck('total', 'jenis_pengurusan');

        $defaultCounts = array_fill_keys($jenisPengurusan, 0);

        return array_merge($defaultCounts, $counts->all());
    }

    /**
     * FUNGSI BARU: Menyediakan data yang sudah diformat untuk Pie Chart.
     */
    protected function getJenisPengurusanForChart()
    {
        // 1. Panggil fungsi yang sudah ada untuk mendapatkan data mentah
        $dataAsosiatif = $this->getJenisPengurusanPemohonCount();

        // 2. Transformasi data menggunakan fungsi array PHP standar
        $labels = array_keys($dataAsosiatif);   // Mengambil semua kunci -> ['KTP', 'baru', ...]
        $series = array_values($dataAsosiatif); // Mengambil semua nilai -> [50, 120, ...]

        // 3. Kembalikan dalam format JSON yang siap pakai
        return [
            'series' => $series,
            'labels' => $labels,
        ];
    }

    protected function getPemohonAndArsipCount ()
    {
        $pemohonCount = Pemohon::count();
        $arsipCount = Arsip::count();

        return [
            'categories' => ['Pemohon', 'Arsip'],
            'seriesData' => [$pemohonCount, $arsipCount]
        ];
    }

    protected function getPemohonWhenPetugasCreatedCount ()
    {
        // Kueri Anda yang sudah bagus, kita gunakan lagi.
        $hasilQuery = Pemohon::query()
            ->select(
                'users.nama_petugas',
                DB::raw('count(dokumen_pemohon.id) as jumlah_pemohon')
            )
            ->join('users', 'dokumen_pemohon.user_id', '=', 'users.id')
            ->groupBy('users.id', 'users.nama_petugas')
            ->orderBy('jumlah_pemohon', 'desc') // Opsional: urutkan dari yang terbanyak
            ->get();

        // --- Transformasi Data untuk ApexCharts ---
        // 'pluck' adalah helper Laravel untuk mengambil semua nilai dari satu kolom.
        $categories = $hasilQuery->pluck('nama_petugas');
        $seriesData = $hasilQuery->pluck('jumlah_pemohon');

        // Kembalikan dalam format JSON yang rapi
        return [
            'categories' => $categories,
            'seriesData' => $seriesData,
        ];
    }

    /**
     * Helper function untuk mengambil data hitungan bulanan dari model tertentu.
     *
     * @param string $modelClass
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return \Illuminate\Support\Collection
     */
    private function getMonthlyCountsForModel(string $modelClass, Carbon $startDate, Carbon $endDate)
    {
        // Kueri ini sangat efisien karena hanya 1x ke database per model.
        return $modelClass::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month_key"),
                DB::raw('count(*) as total')
            )
            ->groupBy('month_key')
            ->pluck('total', 'month_key');
    }

    /**
     * Menyediakan data statistik bulanan untuk chart.
     */
    protected function getMonthlyStats ()
    {
        // --- 1. Tentukan Periode Waktu Dinamis (12 Bulan Terakhir) ---
        // Saat ini (14 Agustus 2025), maka periode akan dari September 2024 - Agustus 2025.
        $endDate = now()->endOfMonth();
        $startDate = now()->subMonths(11)->startOfMonth();

        // --- 2. Ambil Data dari Database Secara Efisien ---
        $pemohonCounts = $this->getMonthlyCountsForModel(Pemohon::class, $startDate, $endDate);
        $arsipCounts = $this->getMonthlyCountsForModel(Arsip::class, $startDate, $endDate);

        // --- 3. Siapkan Struktur Data untuk Chart ---
        $categories = [];
        $pemohonData = [];
        $arsipData = [];

        // Loop dari tanggal mulai hingga tanggal selesai, bulan per bulan.
        $currentDate = $startDate->clone();
        while ($currentDate <= $endDate) {
            // Format 'YYYY-MM' untuk kunci, e.g., '2024-09'
            $monthKey = $currentDate->format('Y-m');
            // Format 'M y' untuk label chart, e.g., 'Sep 25'
            $categories[] = $currentDate->isoFormat('MMM YY');

            // Ambil data dari hasil query, jika tidak ada, beri nilai 0.
            $pemohonData[] = $pemohonCounts[$monthKey] ?? 0;
            $arsipData[] = $arsipCounts[$monthKey] ?? 0;

            $currentDate->addMonth();
        }

        // --- 4. Kembalikan sebagai JSON ---
        return [
            'categories' => $categories,
            'series' => [
                ['name' => 'Pemohon', 'data' => $pemohonData],
                ['name' => 'Arsip', 'data' => $arsipData],
            ]
        ];
    }

    public function getAllStatistic () : JsonResponse
    {
        return response()->json([
            'lokasi_arisp'                      => $this->getLokasiArsipForChart(),
            'jenis_pengurusan_pemohon'          => $this->getJenisPengurusanForChart(),
            'pemohon_and_arisp'                 => $this->getPemohonAndArsipCount(),
            'petugas_create_pemohon'            => $this->getPemohonWhenPetugasCreatedCount(),
            'pemohon_dan_arsip_setiap_bulan'    => $this->getMonthlyStats()
        ]);
    }
}
