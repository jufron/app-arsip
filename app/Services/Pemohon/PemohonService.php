<?php

namespace App\Services\Pemohon;

use App\Models\Pemohon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\EloquentDataTable;
use App\Services\Pemohon\PemohonServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PemohonService implements PemohonServiceInterface
{
    public function getAll () : JsonResponse
    {
        // $model = Pemohon::with('user:id,nama_petugas')->latest();
        $model = Pemohon::query()->with('user:id,nama_petugas')->latest();

        if (request()->filled('jenis_pengurusan')) {
            $model->where('jenis_pengurusan', request('jenis_pengurusan'));

            Log::info('Terapkan WHERE jenis_pengurusan = ' . $model->toSql());
            Log::info('Bindings: ', $model->getBindings()); // ← ini penting

            Log::info('Jenis Pengurusan: '.request('jenis_pengurusan'));
        }

        return $this->renderDataTable($model);
    }

    private function renderDataTable ($model) : JsonResponse
    {
        return (new EloquentDataTable($model))
        ->addIndexColumn()
        ->addColumn('Nik', function (Pemohon $pemohon) {
            return $pemohon->nik;
        })
        ->addColumn('Nama', function (Pemohon $pemohon) {
            return $pemohon->nama;
        })
        ->addColumn('Jenis Pengurusan', function (Pemohon $pemohon) {
            return $pemohon->jenis_pengurusan;
        })
        ->addColumn('Tanggal Pengurusan', function (Pemohon $pemohon) {
            return Carbon::parse($pemohon->tanggal_pengurusan)->translatedFormat('d F Y');
        })
        ->addColumn('Nama Pengurus/Pegawai', function (Pemohon $pemohon) {
            return $pemohon->user->nama_petugas ?? '-';
        })
        ->addColumn('Aksi', function (Pemohon $pemohon) {
            return view('yajra-datatable.action', compact('pemohon'))->render();
        })
        // ->filterColumn('Jenis Pengurusan', function ($query, $keyword) {
        //     $query->orWhere('jenis_pengurusan', request('jenis_pengurusan'));
        // })
        ->filter( function ($query) {
            // * search nama pemohon or nik
            if (request()->has('search') && request('search')['value'] !== '') {
                $query->where('nama', 'like', "%".request('search')['value']."%")
                      ->orWhere('nik', 'like', "%".request('search')['value']."%");
            }

            // * jenis pengurusan
            // Log::info('Jenis Pengurusan: '.request('jenis_pengurusan'));
            // $filter = request('jenis_pengurusan');
            // if (!empty($filter)) {
            //     $query->where('jenis_pengurusan', 'like', "%".request('jenis_pengurusan')."%");
            //     Log::info('Terapkan WHERE jenis_pengurusan = ' . $filter);
            // }

            // if (request()->has('jenis_pengurusan')) {
            //     $query->where('jenis_pengurusan', request()->get('jenis_pengurusan'));
            //     Log::info(
            //         $query->where('jenis_pengurusan', request('jenis_pengurusan'))->toSql()
            //     );
            //     Log::info(request('jenis_pengurusan'));
            // }
            // //  todo : if only start date
            // if (request()->filled('start_date')) {
            //     $query->where('created_at', '>=', request('start_date'));
            // }
            // //  todo : if only end date
            // elseif (request()->filled('end_date')) {
            //     $query->where('created_at', '<=', request('end_date'));
            // }
        }, true)
        ->rawColumns(['Aksi'])
        ->toJson();
    }

    public function storePemohon (Request $request) : void
    {
        Pemohon::create([
            'nik'               => $request->nik,
            'nama'              => $request->nama,
            'jenis_pengurusan'  => $request->jenis_pengurusan,
            'tanggal_pengurusan'=> $request->tanggal_pengurusan,
            'user_id'           => auth()->id(),
        ]);
    }

    public function showPemohon (Pemohon $pemohon) : JsonResponse
    {
        if (!$pemohon) {
            return response()->json(null, 404);
        }

        return response()->json([
            'nik'               => $pemohon->nik,
            'nama'              => $pemohon->nama,
            'jenis_pengurusan'  => $pemohon->jenis_pengurusan,
            'tanggal_pengurusan'=> $pemohon->tanggal_pengurusan,
            'nama_petugas'      => $pemohon->user->nama_petugas,
            'created_at'        => $pemohon->created_at_format,
            'updated_at'        => $pemohon->updated_at_format
        ], 200);
    }

    public function updatePemohon (Pemohon $pemohon, Request $request) : void
    {
        $pemohon->update([
            'nik'               => $request->nik,
            'nama'              => $request->nama,
            'jenis_pengurusan'  => $request->jenis_pengurusan,
            'tanggal_pengurusan'=> $request->tanggal_pengurusan,
            'user_id'           => auth()->id(),
        ]);
    }

    public function destroyPemohon (Pemohon $pemohon) : void
    {
        $pemohon->delete();
    }
}
