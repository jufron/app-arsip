<?php

namespace App\Models;

use App\Traits\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Arsip extends Model
{
    use HasFactory, DateFormatCreatedAtAndUpdatedAt;

    protected $table = 'dokument_arsip';

    protected $fillable = [
        'dokumen_pemohon_id',
        'ruangan',
        'lemari',
        'rak',
        'laci',
        'box',
        'keterangan',
        'tanggal_arsip',
    ];

    public function dokumenPemohon() : BelongsTo
    {
        return $this->belongsTo(Pemohon::class, 'dokumen_pemohon_id');
    }

    public function files() : HasMany
    {
        return $this->hasMany(FileArsip::class, 'dokument_arsip_id');
    }
}
