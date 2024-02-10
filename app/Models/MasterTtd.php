<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTtd extends Model
{
    protected $table = 'master_ttd';
    protected $fillable = [
        'branch',
        'nama',
        'jabatan',
    ];

    public function masterBranchReguler()
    {
        return $this->belongsTo(MasterBranchRegulars::class, 'master_branch_regulars_id', 'id');
    }

    public function masterjabatan()
    {
        return $this->hasMany(Surat::class, 'jabatan_id');
    }
}
