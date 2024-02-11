<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Toko extends Model
{
    use SoftDeletes;

    protected $table = 'toko';
    protected $fillable =
    ['nama_toko', 'alamat', 'nama_pt'];

    public function masterBranchFranchise()
    {
        return $this->belongsTo(MasterBranchFranchise::class, 'master_branch_franchises_id', 'id')->withTrashed();
    }
}
