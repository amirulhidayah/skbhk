<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MasterBranchReguler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRegulerRequest;
use App\Models\MasterBranchRegulars;

class MasterBranchRegulerController extends Controller
{
    public function index()
    {
        $masterbranchregulars = MasterBranchRegulars::all();
        return view('admin.masterbranchreguler.index', compact('masterbranchregulars'));
    }
    public function updateStatus(Request $request, $id)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'status' => 'required|boolean',
        ]);
        // Ubah status di database
        $item = MasterBranchRegulars::findOrFail($id);
        $item->status = $request->input('status');
        $item->save();
        // $item = MasterBranchReguler::find($id);

        // if (!$item) {
        //     return response()->json(['message' => 'Catatan tidak ditemukan'], 404);
        // }

        // // Update status berdasarkan nilai checkbox
        // $item->status = $request->input('status');
        // $item->save();

        // return response()->json(['message' => 'Status berhasil diperbarui']);
    }

    public function create()
    {
        return view('admin.masterbranchreguler.create');
    }
    public function store(BranchRegulerRequest $request)

    {
        $data = $request->validated();
        $masterbranchregulars = new MasterBranchRegulars();
        $masterbranchregulars->branch = $data['branch'];
        $masterbranchregulars->alamat = $data['alamat'];
        $masterbranchregulars->no_telp = $data['no_telp'];
        $masterbranchregulars->no_fax = $data['no_fax'];
        $masterbranchregulars->kota = $data['kota'];
        $masterbranchregulars->save();
        return redirect('admin/masterbranchreguler')->with('success', 'Data Branch Reguler Berhasil Ditambahkan');
    }
    public function edit($masterbranchreguler_id)
    {
        $masterbranchregulars = MasterBranchRegulars::find($masterbranchreguler_id);
        return view('admin.masterbranchreguler.edit', compact(['masterbranchregulars']));
    }
    public function update(BranchRegulerRequest $request, $masterbranchregulars_id)

    {
        $data = $request->validated();
        $masterbranchregulars = MasterBranchRegulars::find($masterbranchregulars_id);
        $masterbranchregulars->branch = $data['branch'];
        $masterbranchregulars->alamat = $data['alamat'];
        $masterbranchregulars->no_telp = $data['no_telp'];
        $masterbranchregulars->no_fax = $data['no_fax'];
        $masterbranchregulars->kota = $data['kota'];
        $masterbranchregulars->update();
        return redirect('admin/masterbranchreguler')->with('success', 'Data Branch Reguler Berhasil Diedit');
    }
    public function destroy($masterbranchreguler_id)
    {
        $masterbranchreguler = MasterBranchRegulars::find($masterbranchreguler_id);
        if ($masterbranchreguler) {
            $masterbranchreguler->delete();
            return redirect('admin/masterbranchreguler')->with('success', 'Data Branch Reguler Berhasil Dihapus');
        } else {
            return redirect('admin/masterbranchreguler')->with('success', 'Data Branch Reguler Berhasil tidak ditemukan');
        }
    }
}
