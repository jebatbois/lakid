<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_merek',
        'jenis',
        'deskripsi_karya',
        'status',
        
        // --- TAMBAHKAN INI AGAR TIDAK SELALU MANDIRI ---
        'kategori',        // <--- WAJIB ADA
        'tahun',           // <--- WAJIB ADA
        'tahapan_proses',  // <--- WAJIB ADA
        // -----------------------------------------------

        'file_logo',
        'file_ktp',
        'file_surat_rekomendasi',
        'catatan_admin',
        'judul_ciptaan',
        'file_karya',
        'file_surat_permohonan',
        'file_cv',
        'file_npwp',
        'file_foto_produk',
        'file_surat_umk',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
