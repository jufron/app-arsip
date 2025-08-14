<?php

namespace App\Services\LogProses;

use App\Models\LogProses;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\EloquentDataTable;
use App\Services\LogProses\LogProsesServiceInterface;

class LogProsesService implements LogProsesServiceInterface
{
    public function getAll () : JsonResponse
    {
        $model = LogProses::query()->latest();
        return $this->renderDataTable($model);
    }

    private function renderDataTable ($model) : JsonResponse
    {
        return (new EloquentDataTable($model))
        ->addIndexColumn()
        ->addColumn('Petugas', function (LogProses $logProses) {
            return $logProses->petugas;
        })
        ->addColumn('Tindakan', function (LogProses $logProses) {
            return $logProses->aksi_style;
        })
        ->addColumn('Deskripsi', function (LogProses $logProses) {
            return $logProses->tindakan_limit;
        })
        ->addColumn('Waktu', function (LogProses $logProses) {
            return $logProses->waktu;
        })
        ->addColumn('Tanggal', function (LogProses $logProses) {
            return $logProses->created_at_format;
        })
        ->addColumn('Aksi', function (LogProses $logProses) {
            return view('yajra-datatable.logAktivitas.action', compact('logProses'))->render();
        })
        ->filter( function ($query) {
            // * search nama pemohon or nik
            if (request()->has('search') && request('search')['value'] !== '') {
                $query->where('petugas', 'like', "%".request('search')['value']."%")
                      ->orWhere('tindakan', 'like', "%".request('search')['value']."%");
            }
        }, true)
        ->rawColumns(['Aksi', 'Tindakan'])
        ->toJson();
    }

    public function showLogProses (LogProses $logProses) : JsonResponse
    {
        if (!$logProses) {
            return response()->json(null, 404);
        }

        return response()->json([
            'petugas'        => $logProses->petugas,
            'aksi'           => $logProses->aksi_style,
            'tindakan'       => $logProses->tindakan,
            'waktu'          => $logProses->waktu,
            'tanggal'        => $logProses->created_at_format
        ], 200);
    }
}
