<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'pendidikan',
        'jabatan',
        'group_employee',
        'no_surat',
        'tgl_awal_hubker',
        'tgl_akhir_hubker',
        'jabatan_ttd',
        'jenis_surat',
        'alasan',
        'jenis_pkwt',
        'no_pkwt',
        'tgl_pkwt',
        'nama_pt',
        'nama_toko',
        'editor_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id')->withTrashed();
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id')->withTrashed();
    }

    public function masterTtd()
    {
        return $this->belongsTo(MasterTtd::class, 'master_ttd_id', 'id')->withTrashed();
    }
}
