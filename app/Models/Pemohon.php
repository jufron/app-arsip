<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemohon extends Model
{
    use HasFactory, DateFormatCreatedAtAndUpdatedAt;

    protected $table = 'dokumen_pemohon';

    protected $fillable = [
        'nik',
        'nama',
        'jenis_pengurusan',
        'tanggal_pengurusan',
        'user_id',
    ];

    protected function tanggalPengurusanFormat() : Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->tanggal_pengurusan)->format('d F Y'),
        );
    }

    // ? relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function arsip()
    {
        return $this->hasOne(Arsip::class, 'dokumen_pemohon_id');
    }
}
