<?php

namespace App\Services\Arsip;

use Carbon\Carbon;
use App\Models\Arsip;
use App\Models\Pemohon;
use App\Models\FileArsip;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;
use App\Services\Arsip\ArsipServiceInterface;

class ArsipService implements ArsipServiceInterface
{
    public function getAll(): JsonResponse
    {
        $model = Arsip::query()->with('dokumenPemohon')->latest();
        return $this->renderDataTable($model);
    }

    private function renderDataTable ($model) : JsonResponse
    {
        return (new EloquentDataTable($model))
        ->addIndexColumn()
        ->addColumn('Nama Pemohon', function (Arsip $arsip) {
            return $arsip->dokumenPemohon->nama ?? '-';
        })
        ->addColumn('Tanggal Pengurusan', function (Arsip $arsip) {
            return Carbon::parse($arsip->dokumenPemohon->tanggal_pengurusan)->translatedFormat('d F Y');
        })
        ->addColumn('Tanggal Arsip', function (Arsip $arsip) {
            return Carbon::parse($arsip->tanggal_arsip)->translatedFormat('d F Y');
        })
        ->addColumn('Ruangan', function (Arsip $arsip) {
            return $arsip->ruangan;
        })
        ->addColumn('Lemari', function (Arsip $arsip) {
            return $arsip->lemari;
        })
        ->addColumn('Rak', function (Arsip $arsip) {
            return $arsip->rak;
        })
        ->addColumn('Laci', function (Arsip $arsip) {
            return $arsip->rak;
        })
        ->addColumn('Box', function (Arsip $arsip) {
            return $arsip->rak;
        })
        ->addColumn('Aksi', function (Arsip $arsip) {
            return view('yajra-datatable.arsip.action', compact('arsip'))->render();
        })
        ->filter( function ($query) {
            // * search nama pemohon or nik
            if (request()->has('search') && request('search')['value'] !== '') {
                $query->where('ruangan', 'like', "%".request('search')['value']."%")
                      ->orWhere('lemari', 'like', "%".request('search')['value']."%")
                      ->orWhere('rak', 'like', "%".request('search')['value']."%")
                      ->orWhere('laci', 'like', "%".request('search')['value']."%")
                      ->orWhere('box', 'like', "%".request('search')['value']."%");
            }
        }, true)
        ->rawColumns(['Aksi'])
        ->toJson();
    }

    public function getDokumenPemohon()
    {
        return Pemohon::doesntHave('arsip')->with('user')->get();
    }

    public function storeArsip(Request $request): void
    {
        try {
            DB::beginTransaction();

            $arsip = Arsip::create([
                'dokumen_pemohon_id' => $request->dokumen_pemohon_id,
                'ruangan'            => $request->ruangan,
                'lemari'             => $request->lemari,
                'rak'                => $request->rak,
                'laci'               => $request->laci,
                'box'                => $request->box,
                'keterangan'         => $request->keterangan,
                'tanggal_arsip'      => $request->tanggal_arsip,
            ]);

            $resultFileSStore = [];

            foreach ($request->file('files') as $file) {
                $resultFileSStore[] = $file->store('arsip', 'public');
            }

            foreach ($resultFileSStore as $file) {
                $arsip->files()->create([
                    'nama_file' => $file,
                ]);
            }

            DB::commit();
            notify()->success('Data Arsip berhasil ditambahkan', 'Sukses');

        } catch (\Exception $th) {
            DB::rollBack();
            Log::error('Error storing Arsip: ' . $th->getMessage());
            notify()->error('Data Arsip gagal ditambahkan', 'Gagal');
        }
    }

    public function showArsip(Arsip $arsip): JsonResponse
    {
        if (!$arsip) {
            return response()->json(null, 404);
        }

        return response()->json([
            'nik'                   => $arsip->dokumenPemohon->nik,
            'nama'                  => $arsip->dokumenPemohon->nama,
            'jenis_pengurusan'      => $arsip->dokumenPemohon->jenis_pengurusan,
            'tanggal_pengurusan'    => $arsip->dokumenPemohon->tanggal_pengurusan,
            'nama_petugas'          => $arsip->dokumenPemohon->user->nama_petugas,
            'ruangan'               => $arsip->ruangan,
            'lemari'                => $arsip->lemari,
            'rak'                   => $arsip->rak,
            'laci'                  => $arsip->laci,
            'box'                   => $arsip->box,
            'keterangan'            => $arsip->keterangan,
            'tanggal_arsip'         => $arsip->tanggal_arsip,
            'created_at'            => $arsip->created_at_format,
            'updated_at'            => $arsip->updated_at_format
        ], 200);
    }

    public function updateArsip(Arsip $arsip, Request $request): void
    {
        $arsip->update([
            'ruangan'               => $request->ruangan,
            'lemari'                => $request->lemari,
            'rak'                   => $request->rak,
            'laci'                  => $request->laci,
            'box'                   => $request->box,
            'keterangan'            => $request->keterangan,
            'tanggal_arsip'         => $request->tanggal_arsip,
        ]);
    }

    public function destroyArsip(Arsip $arsip): void
    {
        $arsip->delete();
    }
}
