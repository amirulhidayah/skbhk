<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBranchFranchise extends Model
{
    protected $table ='master_branch_franchises';
    protected $fillable =[
        'nama_pt',
        'alamat',
        'no_telp',
        'no_fax',
        'status'
    ];
    public function surats()
    {
        return $this->hasMany(Surat::class, 'group_employee', 'nama_pt');
    }
}
