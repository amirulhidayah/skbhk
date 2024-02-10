<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'toko';
    protected $fillable =
    ['nama_toko', 'alamat', 'nama_pt'];

    public function masterBranchFranchise()
    {
        return $this->belongsTo(MasterBranchFranchise::class, 'master_branch_franchises_id', 'id');
    }
}
