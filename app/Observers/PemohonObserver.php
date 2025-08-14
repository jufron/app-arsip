<?php

namespace App\Observers;

use App\Models\Pemohon;
use App\Models\LogProses;

class PemohonObserver
{
    private function setLogProses ($petugas, $aksi, $tindakan)
    {
        LogProses::create([
            'petugas'   => $petugas,
            'aksi'      => $aksi,
            'tindakan'  => $tindakan
        ]);
    }

    /**
     * Handle the Pemohon "created" event.
     */
    public function created(Pemohon $pemohon): void
    {
        $this->setLogProses(
            auth()->user()->nama_petugas,
            "Create Pemohon",
            "Menambahkan Permohnan Baru Nik : {$pemohon->nik}, Nama : {$pemohon->nama}, Jenis Pengurusan : {$pemohon->jenis_pengurusan}, Tanggal Pengurusan : {$pemohon->tanggal_pengurusan_format}, Petugas Penginput : {$pemohon->user->nama_petugas}"
        );
    }

    /**
     * Handle the Pemohon "updated" event.
     */
    public function updated(Pemohon $pemohon): void
    {
        $dataLama = $pemohon->getOriginal(); // Data sebelum update
        $perubahan = $pemohon->getDirty();   // Field yang berubah

        // Susun ringkasan perubahan dalam satu baris
        $ringkasanPerubahan = [];
        foreach ($perubahan as $field => $nilaiBaru) {
            $nilaiLama = $dataLama[$field] ?? null;
            $ringkasanPerubahan[] = "{$field}: '{$nilaiLama}' → '{$nilaiBaru}'";
        }

        $deskripsiPerubahan = implode(", ", $ringkasanPerubahan);

        $this->setLogProses(
            auth()->user()->nama_petugas,
            "Update Pemohon",
            "Memperbarui data Pemohon NIK: {$pemohon->nik}, Nama: {$pemohon->nama} | Perubahan: {$deskripsiPerubahan}"
        );

    }

    /**
     * Handle the Pemohon "deleted" event.
     */
    public function deleted(Pemohon $pemohon): void
    {
         $this->setLogProses(
            auth()->user()->nama_petugas,
            "Delete Pemohon",
            "Menghapus Pemohon NIK: {$pemohon->nik}, Nama: {$pemohon->nama}, "
            . "Jenis Pengurusan: {$pemohon->jenis_pengurusan}, "
            . "Tanggal Pengurusan: {$pemohon->tanggal_pengurusan_format}"
        );
    }

    /**
     * Handle the Pemohon "restored" event.
     */
    public function restored(Pemohon $pemohon): void
    {
        //
    }

    /**
     * Handle the Pemohon "force deleted" event.
     */
    public function forceDeleted(Pemohon $pemohon): void
    {
         $this->setLogProses(
            auth()->user()->nama_petugas,
            "Delete Pemohon",
            "Menghapus Pemohon NIK: {$pemohon->nik}, Nama: {$pemohon->nama}, "
            . "Jenis Pengurusan: {$pemohon->jenis_pengurusan}, "
            . "Tanggal Pengurusan: {$pemohon->tanggal_pengurusan_format}"
        );
    }
}
