<?php

namespace App\Models;

use App\Traits\DateFormatCreatedAtAndUpdatedAt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function arsip()
    {
        return $this->hasOne(Arsip::class, 'dokumen_pemohon_id');
    }
}
