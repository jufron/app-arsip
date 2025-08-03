<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileArsip extends Model
{
    protected $table = 'arsip_file';

    protected $fillable = [
        'dokument_arsip_id',
        'nama_file',
    ];

    public function dokumentArsip() : BelongsTo
    {
        return $this->belongsTo(Arsip::class, 'dokument_arsip_id');
    }
}
