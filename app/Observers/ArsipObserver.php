<?php

namespace App\Observers;

use App\Models\Arsip;
use App\Models\LogProses;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class ArsipObserver implements ShouldHandleEventsAfterCommit
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
     * Handle the Arsip "created" event.
     */
    public function created(Arsip $arsip): void
    {
        $this->setLogProses(
            auth()->user()->nama_petugas,
            "Create Arsip",
            "Menambahkan Arsip Baru Nik : {$arsip->dokumenPemohon->nik}, Nama : {$arsip->dokumenPemohon->nama}, Jenis Pengurusan : {$arsip->dokumenPemohon->jenis_pengurusan}, Tanggal Pengurusan : {$arsip->dokumenPemohon->tanggal_pengurusan_format}, Petugas Penginput : {$arsip->dokumenPemohon->user->nama_petugas}, Lokasi : {$arsip->ruangan} {$arsip->lemari} {$arsip->rak} {$arsip->laci} {$arsip->box}, Keterangan : {$arsip->keterangan}, Tanggal Arsip : {$arsip->tanggal_arsip_format}"
        );
    }

    /**
     * Handle the Arsip "updated" event.
     */
    public function updated(Arsip $arsip): void
    {
        $dataLama   = $arsip->getOriginal(); // Data sebelum update
        $perubahan  = $arsip->getDirty();    // Field yang berubah

        // Susun ringkasan perubahan
        $ringkasanPerubahan = [];
        foreach ($perubahan as $field => $nilaiBaru) {
            $nilaiLama = $dataLama[$field] ?? null;
            $ringkasanPerubahan[] = "{$field}: '{$nilaiLama}' → '{$nilaiBaru}'";
        }
        $deskripsiPerubahan = implode(", ", $ringkasanPerubahan);

        $this->setLogProses(
            auth()->user()->nama_petugas,
            "Update Arsip",
            "Memperbarui Arsip NIK: {$arsip->dokumenPemohon->nik}, Nama: {$arsip->dokumenPemohon->nama}, Jenis Pengurusan: {$arsip->dokumenPemohon->jenis_pengurusan}, Tanggal Pengurusan: {$arsip->dokumenPemohon->tanggal_pengurusan_format}, Lokasi: {$arsip->ruangan} {$arsip->lemari} {$arsip->rak} {$arsip->laci} {$arsip->box} | Perubahan: {$deskripsiPerubahan}"
        );
    }

    /**
     * Handle the Arsip "deleted" event.
     */
    public function deleted(Arsip $arsip): void
    {
        $this->setLogProses(
            auth()->user()->nama_petugas,
            "Delete Arsip",
            "Menghapus Arsip NIK: {$arsip->dokumenPemohon->nik}, Nama: {$arsip->dokumenPemohon->nama}, Jenis Pengurusan: {$arsip->dokumenPemohon->jenis_pengurusan}, Tanggal Pengurusan: {$arsip->dokumenPemohon->tanggal_pengurusan_format}, Lokasi: {$arsip->ruangan} {$arsip->lemari} {$arsip->rak} {$arsip->laci} {$arsip->box}, Keterangan: {$arsip->keterangan}, Tanggal Arsip: {$arsip->tanggal_arsip_format}"
        );
    }

    /**
     * Handle the Arsip "restored" event.
     */
    public function restored(Arsip $arsip): void
    {
        //
    }

    /**
     * Handle the Arsip "force deleted" event.
     */
    public function forceDeleted(Arsip $arsip): void
    {
        $this->setLogProses(
            auth()->user()->nama_petugas,
            "Delete Arsip",
            "Menghapus Arsip NIK: {$arsip->dokumenPemohon->nik}, Nama: {$arsip->dokumenPemohon->nama}, Jenis Pengurusan: {$arsip->dokumenPemohon->jenis_pengurusan}, Tanggal Pengurusan: {$arsip->dokumenPemohon->tanggal_pengurusan_format}, Lokasi: {$arsip->ruangan} {$arsip->lemari} {$arsip->rak} {$arsip->laci} {$arsip->box}, Keterangan: {$arsip->keterangan}, Tanggal Arsip: {$arsip->tanggal_arsip_format}"
        );
    }
}
