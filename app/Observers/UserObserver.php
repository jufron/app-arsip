<?php

namespace App\Observers;

use App\Models\LogProses;
use App\Models\User;

class UserObserver
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
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->setLogProses(
            auth()->user()->nama_petugas,
            "Create Petugas",
            "Menambahkan Petugas Baru : {$user->nama_petugas}"
        );
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // Ambil data lama sebelum di-update
        $dataLama = $user->getOriginal();

        // Ambil data baru setelah di-update
        $dataBaru = $user->getAttributes();

        $this->setLogProses(
            auth()->user()->nama_petugas,
            "Update Petugas",
            "Memperbaharui Data Petugas : " . $dataLama['name'] . " menjadi: " . $dataBaru['name'] . $dataLama['nama_petugas'] . " menjadi: " . $dataBaru['nama_petugas'] . $dataLama['email'] . " menjadi: " . $dataBaru['email']
        );
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->setLogProses(
            auth()->user()->nama_petugas,
            "Delete Petugas",
            "Menghapus Petugas: {$user->nama_petugas}"
        );
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        $this->setLogProses(
            auth()->user()->nama_petugas,
            "Delete Petugas",
            "Menghapus Petugas: {$user->nama_petugas}"
        );
    }
}
