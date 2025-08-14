<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogProses extends Model
{
    use HasFactory, DateFormatCreatedAtAndUpdatedAt;

    protected $table = 'log_proses';

    protected $fillable = [
        'petugas',
        'aksi',
        'tindakan'
    ];

    protected function aksiStyle (): Attribute
    {
        return Attribute::make(
            get: function () {
               $aksi = $this->aksi;
                if (Str::contains(strtolower($aksi), 'create')) {
                    return "<span class='badge text-bg-success py-2 px-2'>{$aksi}</span>";
                }
                if (Str::contains(strtolower($aksi), 'update')) {
                    return "<span class='badge text-bg-warning py-2 px-2'>{$aksi}</span>";
                }
                if (Str::contains(strtolower($aksi), 'delete')) {
                    return "<span class='badge text-bg-danger py-2 px-2'>{$aksi}</span>";
                }

                return "<span class='badge text-bg-secondary py-2 px-2'>{$aksi}</span>";
            }
        );
    }

    protected function tindakanLimit (): Attribute
    {
        return Attribute::make(
            get: fn () => Str::limit(strip_tags($this->tindakan), 40),
        );
    }

    protected function waktu(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('H:i'),
        );
    }
}
