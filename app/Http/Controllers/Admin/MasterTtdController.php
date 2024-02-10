<?php

namespace App\Http\Controllers\Admin;

use App\Models\MasterTtd;
use Illuminate\Http\Request;
use App\Models\MasterBranchReguler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterTtdRequest;
use App\Models\MasterBranchFranchise;
use App\Models\MasterBranchRegulars;

class MasterTtdController extends Controller
{

    public function index()
    {
        $masterttd = MasterTtd::with('masterBranchReguler')->get();
        return view('admin.masterttd.index', compact('masterttd'));
    }
    public function create()
    {
        $masterBranchRegulars = MasterBranchRegulars::where('status', 1)->get();
        return view('admin.masterttd.create', compact('masterBranchRegulars'));
    }
    public function store(MasterTtdRequest $request)

    {
        $data = $request->validated();
        $masterttd = new MasterTtd();
        $masterttd->nama = $data['nama'];
        $masterttd->jabatan = $data['jabatan'];
        $masterttd->master_branch_regulars_id = $data['master_branch_regulars_id'];
        $masterttd->save();
        return redirect('admin/masterttd')->with('success', 'Data TTD Berhasil Ditambahkan');
    }
    public function edit($masterttd_id)
    {
        $masterttd = MasterTtd::find($masterttd_id);
        $masterbranchregulars = MasterBranchRegulars::where('status', 1)->get();
        return view('admin.masterttd.edit', compact('masterttd', 'masterbranchregulars'));
    }
    public function update(MasterTtdRequest $request, $masterttd_id)
    {
        $data = $request->validated();
        $masterttd = MasterTtd::find($masterttd_id);
        $masterttd->master_branch_regulars_id = $data['master_branch_regulars_id'];
        $masterttd->nama = $data['nama'];
        $masterttd->jabatan = $data['jabatan'];
        $masterttd->update();
        return redirect('admin/masterttd')->with('success', 'Data TTD Berhasil Diedit');
    }
    public function destroy($masterttd_id)
    {
        $masterttd = MasterTtd::find($masterttd_id);
        if ($masterttd) {
            $masterttd->delete();
            return redirect('admin/masterttd')->with('success', 'User Berhasil Dihapus');
        } else {
            return redirect('admin/masterttd')->with('succes', 'User tidak ditemukan');
        }
    }
}
