<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_merek',
        'jenis',
        'deskripsi_karya',
        'status',
        'file_logo',
        'file_ktp',
        'file_surat_umk',
        'catatan_admin',
        'file_surat_rekomendasi',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns this pengajuan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
