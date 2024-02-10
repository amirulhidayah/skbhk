<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterBranchFranchise;
use App\Http\Requests\Admin\BranchFranchiseRequest;

class MasterBranchFranchiseController extends Controller
{
    public function index (){
        $masterbranchfranchise = MasterBranchFranchise::all();
        return view('admin.masterbranchfranchise.index', compact('masterbranchfranchise'));
    }
    public function updateStatus(Request $request, $id)
{
    // Validasi input jika diperlukan
    $request->validate([
        'status' => 'required|boolean',
    ]);

    // Ubah status di database
    $item = MasterBranchFranchise::findOrFail($id);
    $item->status = $request->input('status');
    $item->save();

    return response()->json(['message' => 'Status berhasil diperbarui']);
}

    public function create()
    {
        return view('admin.masterbranchfranchise.create');

    }
    public function store(BranchFranchiseRequest $request)
    
    {
        $data = $request->validated();
        $masterbranchfranchise = new MasterBranchFranchise();
        $masterbranchfranchise->nama_pt = $data['nama_pt'];
        $masterbranchfranchise->alamat = $data['alamat'];
        $masterbranchfranchise->no_telp = $data['no_telp'];
        $masterbranchfranchise->no_fax = $data['no_fax'];
        $masterbranchfranchise->save();
        return redirect('admin/masterbranchfranchise')->with('success','Data Branch Reguler Berhasil Ditambahkan');
    }
    public function edit($masterbranchfranchise_id)
    {
        $masterbranchfranchise = MasterBranchFranchise::find($masterbranchfranchise_id);

        // Periksa apakah data ditemukan
        if (!$masterbranchfranchise) {
            // Anda dapat menangani kasus ketika data tidak ditemukan, misalnya, redirect ke halaman 404.
            abort(404);
        }
    
        // Teruskan data ke tampilan
        return view('admin.masterbranchfranchise.edit', compact('masterbranchfranchise'));
    }
    public function update(BranchFranchiseRequest $request, $masterbranchfranchise_id)
    
    {
         // Ambil data berdasarkan ID
    $masterbranchfranchise = MasterBranchFranchise::findOrFail($masterbranchfranchise_id);

    // Validasi input dan simpan perubahan
    $data = $request->validated();
    $masterbranchfranchise->update($data);

    // Redirect ke halaman yang benar setelah update
    return redirect('admin/masterbranchfranchise')->with('success', 'Data Branch Franchise Berhasil Diedit');
    }
    public function destroy ($surat_id)
    {
        $masterbranchfranchise = MasterBranchFranchise::find($surat_id);
        if($masterbranchfranchise)
        {
            $masterbranchfranchise->delete();
            return redirect('admin/masterbranchfranchise')->with('success', 'Branch Franchise Berhasil Dihapus');
        }
        else
        {
            return redirect('admin/masterbranchfranchise')->with('Eror', 'Surat tidak ditemukan');
        }
    }
    public $delete_id;
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
}
