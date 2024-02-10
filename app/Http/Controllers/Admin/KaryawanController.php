<?php

namespace App\Http\Controllers\Admin;

use id;
use data;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Imports\KaryawanImport;
use App\Models\MasterBranchReguler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Admin\KaryawanRequest;
use App\Http\Requests\Admin\KaryawanEditRequest;
use App\Models\MasterBranchFranchise;
use App\Models\MasterBranchRegulars;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('admin.masterkaryawan.index', compact('karyawan'));
    }
    //untuk user cabang saja
    // public function index()
    // {
    //     // Mendapatkan branch dari pengguna yang sedang login
    //     $branch = Auth::user()->branch; // Sesuaikan dengan nama kolom branch di model User

    //     // Menampilkan hanya data karyawan yang memiliki branch yang sesuai
    //     $karyawan = Karyawan::where('group_employee', $branch)->get();

    //     return view('admin.masterkaryawan.index', compact('karyawan'));
    // }
    public function create()
    {
        $masterBranchRegulars = MasterBranchRegulars::where('status', 1)->get(); // Ganti dengan model dan nama tabel yang sesuai
        $masterBranchFranchises = MasterBranchFranchise::all();
        return view('admin.masterkaryawan.create', compact('masterBranchRegulars', 'masterBranchFranchises'));
    }
    public function store(KaryawanRequest $request)
    {
        $data = $request->validated();

        $karyawan = new Karyawan;
        $karyawan->nik = rc4_encrypt($data['nik']);
        $karyawan->nama = $data['nama'];
        $karyawan->tempat_lahir = $data['tempat_lahir'];
        $karyawan->tanggal_lahir = $data['tanggal_lahir'];
        $karyawan->pendidikan = $data['pendidikan'];
        $karyawan->jabatan = $data['jabatan'];
        $karyawan->master_branch_regulars_id = $data['master_branch_regulars_id'];
        $karyawan->master_branch_franchises_id = $data['master_branch_franchises_id'];
        $karyawan->toko_id = $data['toko_id'];
        $karyawan->no_surat = $data['no_surat'];
        $karyawan->tgl_awal_hubker = $data['tgl_awal_hubker'];
        $karyawan->tgl_akhir_hubker = $data['tgl_akhir_hubker'];
        $karyawan->jenis_pkwt = $data['jenis_pkwt'];
        $karyawan->no_pkwt = $data['no_pkwt'];
        $karyawan->tgl_pkwt = $data['tgl_pkwt'];
        $karyawan->save();
        return redirect('admin/masterkaryawan')->with('success', 'Data Karyawan Berhasil Ditambahkan');
    }
    public function edit($karyawan_id)
    {
        $karyawan = Karyawan::find($karyawan_id);
        $masterBranchRegulars = MasterBranchRegulars::where('status', 1)->get();
        $masterBranchFranchises = MasterBranchFranchise::all();
        return view('admin.masterkaryawan.edit', compact('karyawan', 'masterBranchRegulars', 'masterBranchFranchises'));
    }
    public function update(KaryawanEditRequest $request, $karyawan_id)
    {
        $data = $request->validated();
        $karyawan = Karyawan::find($karyawan_id);
        $karyawan->nik = rc4_encrypt($data['nik']);
        $karyawan->nama = $data['nama'];
        $karyawan->tempat_lahir = $data['tempat_lahir'];
        $karyawan->tanggal_lahir = $data['tanggal_lahir'];
        $karyawan->pendidikan = $data['pendidikan'];
        $karyawan->jabatan = $data['jabatan'];
        $karyawan->master_branch_regulars_id = $data['master_branch_regulars_id'];
        $karyawan->master_branch_franchises_id = $data['master_branch_franchises_id'];
        $karyawan->toko_id = $data['toko_id'];
        $karyawan->no_surat = $data['no_surat'];
        $karyawan->tgl_awal_hubker = $data['tgl_awal_hubker'];
        $karyawan->tgl_akhir_hubker = $data['tgl_akhir_hubker'];
        $karyawan->jenis_pkwt = $data['jenis_pkwt'];
        $karyawan->no_pkwt = $data['no_pkwt'];
        $karyawan->tgl_pkwt = $data['tgl_pkwt'];
        $karyawan->update();
        return redirect('admin/masterkaryawan')->with('success', 'Data Karyawan Berhasil Diedit');
    }
    public function destroy($karyawan_id)
    {
        $karyawan = Karyawan::find($karyawan_id);
        if ($karyawan) {
            $karyawan->delete();
            return redirect('admin/masterkaryawan')->with('success', 'Data Karyawan Berhasil Dihapus');
        } else {
            return redirect('admin/masterkaryawan')->with('success', 'Data Karyawan tidak ditemukan');
        }
    }

    public function autocomplete(Request $request)
    {
        $term = $request->input('term');
        $data = Karyawan::where('nama', 'LIKE', "%$term%")->get();

        return response()->json($data);
    }

    public function autofill($id)
    {
        $karyawan = Karyawan::find($id);
        return response()->json($karyawan);
    }

    public function import(Request $request)
    {
        try {
            $file = $request->file('file');

            if ($file) {
                Excel::import(new KaryawanImport,   $file);

                return redirect()->back()->with('success', 'Data berhasil di impor.');
            } else {
                return redirect()->back()->with('error', 'File tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
