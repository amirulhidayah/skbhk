<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterBranchRegulars extends Model
{
    use SoftDeletes;

    protected $table = 'master_branch_regulars';
    protected $fillable = [
        'branch',
        'alamat',
        'no_telp',
        'no_fax',
        'kota',

    ];
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'branch_id')->withTrashed();
    }
    public function masterttd()
    {
        return $this->hasMany(MasterTtd::class, 'branch_id')->withTrashed();
    }
    public function namapt()
    {
        return $this->hasMany(Toko::class, 'id')->withTrashed();
    }
}
