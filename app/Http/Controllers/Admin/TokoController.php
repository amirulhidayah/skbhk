<?php

namespace App\Http\Controllers\Admin;

use App\Models\Toko;
use App\Models\MasterTtd;
use Illuminate\Http\Request;
use App\Models\MasterBranchReguler;
use App\Http\Controllers\Controller;
use App\Models\MasterBranchFranchise;
use App\Http\Requests\Admin\MasterTtdRequest;
use App\Http\Requests\Admin\MasterTokoRequest;

class TokoController extends Controller
{

    public function index()
    {
        $mastertoko = Toko::all();
        return view('admin.mastertoko.index', compact('mastertoko'));
    }
    public function create()
    {
        $masterBranchFranchise = MasterBranchFranchise::where('status', 1)->get();
        return view('admin.mastertoko.create', compact('masterBranchFranchise'));
    }
    public function store(MasterTokoRequest $request)

    {
        $data = $request->validated();
        $mastertoko = new Toko();
        $mastertoko->nama_toko = $data['nama_toko'];
        $mastertoko->alamat = $data['alamat'];
        $mastertoko->master_branch_franchises_id = $data['master_branch_franchises_id'];
        $mastertoko->save();
        return redirect('admin/mastertoko')->with('success', 'Data Toko Berhasil Ditambahkan');
    }
    public function edit($mastertoko_id)
    {
        $mastertoko = Toko::find($mastertoko_id);
        $masterBranchFranchise = MasterBranchFranchise::where('status', 1)->get();
        return view('admin.mastertoko.edit', compact('mastertoko', 'masterBranchFranchise'));
    }
    public function update(MasterTokoRequest $request, $mastertoko_id)
    {
        $data = $request->validated();
        $mastertoko = Toko::find($mastertoko_id);
        $mastertoko->nama_toko = $data['nama_toko'];
        $mastertoko->alamat = $data['alamat'];
        $mastertoko->master_branch_franchises_id = $data['master_branch_franchises_id'];
        $mastertoko->update();
        return redirect('admin/mastertoko')->with('success', 'Data Toko Berhasil Diedit');
    }
    public function destroy($mastertoko_id)
    {
        $mastertoko = Toko::find($mastertoko_id);
        if ($mastertoko) {
            $mastertoko->delete();
            return redirect('admin/mastertoko')->with('success', 'Toko Berhasil Dihapus');
        } else {
            return redirect('admin/masterttd')->with('succes', 'Toko tidak ditemukan');
        }
    }
}
