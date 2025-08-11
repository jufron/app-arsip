<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected function tanggalArsipFormat() : Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->tanggal_arsip)->format('d F Y'),
        );
    }

    // ? relation
    public function dokumenPemohon() : BelongsTo
    {
        return $this->belongsTo(Pemohon::class, 'dokumen_pemohon_id');
    }

    public function files() : HasMany
    {
        return $this->hasMany(FileArsip::class, 'dokument_arsip_id');
    }
}
