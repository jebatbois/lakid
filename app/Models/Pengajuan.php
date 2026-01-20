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
    'jenis', // Merek / Hak Cipta
    'deskripsi_karya',
    'status',
    
    // File Lama
    'file_logo',
    'file_ktp',
    'file_surat_rekomendasi', // Dari Admin
    'catatan_admin',          // Dari Admin

    // FILE BARU (Wajib Ditambahkan!)
    'judul_ciptaan',
    'file_karya',             // File Lagu/Naskah
    'file_surat_permohonan',
    'file_cv',
    'file_npwp',
    'file_foto_produk',
    'file_surat_umk',
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
