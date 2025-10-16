<?php

namespace App\Services\Arsip;

use Exception;
use Carbon\Carbon;
use App\Models\Arsip;
use App\Models\Pemohon;
use App\Models\FileArsip;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder;
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
                $query->whereHas('dokumenPemohon', function (Builder $query) {
                        $query->where('nama', 'like', "%".request('search')['value']."%");
                    })
                      ->orWhere('ruangan', 'like', "%".request('search')['value']."%")
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

            $resultFileSStore = [];

            foreach ($request->file('files') as $file) {
                $resultFileSStore[] = $file->store('arsip', 'public');
            }

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
            'tanggal_pengurusan'    => $arsip->dokumenPemohon->tanggal_pengurusan_format,
            'nama_petugas'          => $arsip->dokumenPemohon->user->nama_petugas,
            'ruangan'               => $arsip->ruangan,
            'lemari'                => $arsip->lemari,
            'rak'                   => $arsip->rak,
            'laci'                  => $arsip->laci,
            'box'                   => $arsip->box,
            'keterangan'            => $arsip->keterangan,
            'tanggal_arsip'         => $arsip->tanggal_arsip_format,
            'files'                 => $arsip->files->map(function (FileArsip $file) {
                return [
                    'id'         => $file->id,
                    'url'        => asset('storage/' . $file->nama_file),
                ];
            }),
            'created_at'            => $arsip->created_at_format,
            'updated_at'            => $arsip->updated_at_format
        ], 200);
    }

    public function updateArsip(Arsip $arsip, Request $request): void
    {
        try {
            DB::beginTransaction();

            $resultFileSStore = [];

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    if ($file->isValid()) {
                        $resultFileSStore[] = $file->store('arsip', 'public');
                    }
                }
            }

            $arsip->update([
                'ruangan'            => $request->ruangan,
                'lemari'             => $request->lemari,
                'rak'                => $request->rak,
                'laci'               => $request->laci,
                'box'                => $request->box,
                'keterangan'         => $request->keterangan,
                'tanggal_arsip'      => $request->tanggal_arsip,
            ]);

            // Simpan file baru ke relasi jika ada
            if (!empty($resultFileSStore)) {
                foreach ($resultFileSStore as $file) {
                    $arsip->files()->create([
                        'nama_file' => $file,
                    ]);
                }
            }

            DB::commit();
            notify()->success('Data Arsip berhasil Diperbaharui', 'Sukses');

        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error Update Arsip: ' . $th->getMessage());
            notify()->error('Data Arsip gagal Diperbaharui', 'Gagal');
        }
    }

    public function destroyArsip(Arsip $arsip): void
    {
        try {
            DB::beginTransaction();

            // Pastikan relasi 'files' ada dan isinya tidak kosong
            if ($arsip->files && $arsip->files()->count() > 0) {
                foreach ($arsip->files as $file) {
                    if ($file->nama_file && Storage::disk('public')->exists($file->nama_file)) {
                        Storage::disk('public')->delete($file->nama_file);
                    }
                }
            }

            $arsip->files()->delete();
            $arsip->delete();

            DB::commit();

            notify()->success('Data Arsip berhasil dihapus', 'Berhasil');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error deleting Arsip: ' . $th->getMessage());
            notify()->error('Data Arsip gagal dihapus', 'Gagal');
        }
    }

    public function destroyFileArsip (FileArsip $fileArsip) : void
    {
        if ($fileArsip->nama_file && Storage::disk('public')->exists($fileArsip->nama_file)) {
            Storage::disk('public')->delete($fileArsip->nama_file);
        }
        $fileArsip->delete();
    }
}
