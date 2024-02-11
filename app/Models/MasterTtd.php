<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterTtd extends Model
{
    use SoftDeletes;

    protected $table = 'master_ttd';
    protected $fillable = [
        'branch',
        'nama',
        'jabatan',
    ];

    public function masterBranchReguler()
    {
        return $this->belongsTo(MasterBranchRegulars::class, 'master_branch_regulars_id', 'id')->withTrashed();
    }

    public function masterjabatan()
    {
        return $this->hasMany(Surat::class, 'jabatan_id');
    }
}
