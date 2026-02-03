<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori',
        'jenis',
        'nama_merek',
        'deskripsi_karya',
        'tahun',
        'status',
        'tahapan_proses',
        
        // File Paths
        'file_ktp',
        'file_ttd', // <-- TAMBAHAN BARU
        'file_npwp',
        'file_surat_permohonan',
        'file_logo',
        'file_karya',
        'file_cv',
        'file_surat_umk',
        'file_foto_produk',
        'file_surat_rekomendasi',
        'catatan_admin',

        // Field Ekraf
        'subsektor_ekraf',
        'lokasi_usaha',
        'hasil_produk',
        'modal_usaha',
        'jumlah_tenaga_kerja',
        'pemasaran_distribusi',
        'omzet_bulanan',
        'usulan_nama_merek',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}