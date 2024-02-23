<?php

namespace App\Http\Controllers\Admin;

use PDF;
use data;
use App\Models\User;
use App\Models\Surat;
use App\Models\Karyawan;
use App\Models\MasterTtd;
use Illuminate\Http\Request;
use App\Models\MasterBranchReguler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterBranchFranchise;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Admin\SuratRequest;
use Illuminate\Contracts\Validation\Rule;

class SuratController extends Controller
{
    public function infosurat()
    {
        $surat = Surat::all();
        return view('admin.surat.infosurat', compact('surat'));
    }
    public function index(Request $request)
    {

        $userBranch = auth()->user()->branch;
        $masterTtd = MasterTtd::all();
        $employees = [];
        if ($request->has('karyawan_nik')) {
            $karyawan_nik = rc4_encrypt($request->input('karyawan_nik'));
            $employees = Karyawan::where('nik', $karyawan_nik)->get();
        }

        return view('admin.surat.index', compact('employees', 'masterTtd'));
    }
    // public function search(Request $request)
    // {
    //     // Mengambil branch dari user saat ini
    //     $userBranch = auth()->user()->branch;

    //     // Debugging untuk memeriksa nilai branch yang diambil
    //     dd($userBranch);

    //     $employee = null;

    //     if ($request->has('karyawan_nik')) {
    //         $karyawan_nik = $request->input('karyawan_nik');

    //         // Menambahkan kondisi where untuk memfilter berdasarkan branch
    //         $employee = Karyawan::where('nik', $karyawan_nik)
    //             ->where('group_employee', $userBranch)
    //             ->first();
    //     }

    //     return view('admin.surat.index', compact('employee'));
    // }



    public function store(Request $request)
    {

        //    dd($request->all());

        // Validasi data yang masuk di sini jika diperlukan
        $validatedData = $request->validate([
            'jenis_surat' => [
                'required',
                'string',
            ],
            'alasan' => [
                'required',
                'string',
            ],
            'tgl_akhir_hubker' => [
                'nullable',
                'date',
            ],
            'master_ttd_id' => [
                'required',
            ],
            'no_surat' => [
                'required',
                'string',
            ],
        ]);

        // Simpan data surat ke database
        $data = $validatedData;
        $user_id = auth()->user()->id;
        $karyawan = Karyawan::where('nik', rc4_encrypt($request->nik))->first();
        $karyawan->tgl_akhir_hubker = $data['tgl_akhir_hubker'];
        $karyawan->save();

        $surat = new Surat;
        $surat->alasan = $data['alasan'];
        $surat->no_surat = $data['no_surat'];
        $surat->jenis_surat = $data['jenis_surat'];
        $surat->users_id = $user_id;
        $surat->karyawan_id = $karyawan->id;
        $surat->master_ttd_id = $data['master_ttd_id'];

        if ($surat->save()) {
            // dd ("berhasil");
            return redirect('admin/infosurat')->with('success', 'SKBHK Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
    }
    public function generatePDF($surat_id)
    {
        $surat = Surat::find($surat_id);

        if ($surat) {
            $data = [
                'title' => 'Surat SKBHK',
                'surat' => $surat
            ];

            $pdf = null;
            $fileName = "";

            if ($surat->jenis_surat === 'Choice 1' || $surat->jenis_surat === 'Choice 3') {
                $pdf = PDF::loadView('admin.surat.myPDF', $data);
                $fileName = "Surat SKBHK $surat->nama.pdf";
                // Tambahkan kondisi lain berdasarkan jenis surat dan alasan yang sesuai
            } elseif ($surat->jenis_surat === 'Choice 2' || $surat->jenis_surat === 'Choice 4') {
                // Logika untuk jenis surat pertama dan alasan pertama
                $pdf = PDF::loadView('admin.surat.myPDF2', $data);
                $fileName = "Surat SKBHK $surat->nama.pdf";
            }
            if ($pdf) {
                return $pdf->download($fileName);
            } else {
                return redirect('admin/infosurat')->with('error', 'Tidak ada PDF yang sesuai untuk jenis surat ini.');
            }
        } else {
            return redirect('admin/infosurat')->with('error', 'Surat tidak ditemukan.');
        }
    }
    public function printPDF($surat_id)
    {

        $surat = Surat::find($surat_id);


        if ($surat) {
            $data = [
                'title' => 'Surat SKBHK',
                'surat' => $surat
            ];

            $pdf = null;
            $fileName = "";

            if ($surat->jenis_surat === 'Choice 1' || $surat->jenis_surat === 'Choice 3') {
                $pdf = PDF::loadView('admin.surat.myPDF', $data);
                $fileName = "Surat SKBHK $surat->nama.pdf";
                // Tambahkan kondisi lain berdasarkan jenis surat dan alasan yang sesuai
            } elseif ($surat->jenis_surat === 'Choice 2' || $surat->jenis_surat === 'Choice 4') {
                // Logika untuk jenis surat pertama dan alasan pertama
                $pdf = PDF::loadView('admin.surat.myPDF2', $data);
                $fileName = "Surat SKBHK $surat->nama.pdf";
            }

            if ($pdf) {
                // Menampilkan tampilan PDF langsung
                return view('admin.surat.print', compact('pdf', 'fileName'));
            } else {
                return redirect('admin/infosurat')->with('error', 'Tidak ada PDF yang sesuai untuk jenis surat ini.');
            }
        } else {
            return redirect('admin/infosurat')->with('error', 'Surat tidak ditemukan.');
        }
    }

    public function edit($surat_id)
    {
        $surat =  Surat::find($surat_id);
        $masterTtd = MasterTtd::all();
        $employee = $surat->karyawan;
        return view('admin.surat.edit', compact('surat', 'masterTtd', 'employee'));
    }
    public function update(Request $request, $surat_id)
    { {
            $validatedData = $request->validate([
                'jenis_surat' => [
                    'required',
                    'string',
                ],
                'alasan' => [
                    'required',
                    'string',
                ],
                'master_ttd_id' => [
                    'required',
                ],
                'tgl_akhir_hubker' => [
                    'nullable',
                    'date',
                ],
                'no_surat' => [
                    'required',
                    'string',
                ],
            ]);


            $data = $validatedData;
            $user_id = auth()->user()->id;
            $karyawan = Karyawan::where('nik', rc4_encrypt($request->nik))->first();
            $karyawan->tgl_akhir_hubker = $data['tgl_akhir_hubker'];
            $karyawan->save();

            $surat = Surat::find($surat_id);
            $surat->alasan = $data['alasan'];
            $surat->no_surat = $data['no_surat'];
            $surat->jenis_surat = $data['jenis_surat'];
            $surat->users_id = $user_id;
            $surat->karyawan_id = $karyawan->id;
            $surat->master_ttd_id = $data['master_ttd_id'];
            if ($surat->update()) {
                return redirect('admin/infosurat')->with('success', 'Surat Berhasil Diedit');

                $editor = $surat->editor;

                // Ambil nama pengedit
                $editorName = $editor ? $editor->name : 'Tidak ada informasi pengedit';
            } else {
                return redirect()->back()->with('error', 'Gagal menyimpan data.');
            }
        }
    }
    public function destroy($surat_id)
    {
        $surat = Surat::find($surat_id);
        if ($surat) {
            $surat->delete();
            return redirect('admin/infosurat')->with('success', 'Surat Berhasil Dihapus');
        } else {
            return redirect('admin/infosurat')->with('success', 'Surat tidak ditemukan');
        }
    }
    public $delete_id;
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function importpdf(Request $request, $surat_id)
    {
        $file = $request->file('file');

        // Check if a file is uploaded
        if ($file) {
            // Check if the uploaded file is a PDF
            if ($file->getClientOriginalExtension() === 'pdf') {
                $destinationPath = "upload";

                // Save file to storage
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $filename);

                // Save file information to database
                $surat = Surat::find($surat_id);
                $surat->file_path = $filename;
                $surat->save();

                if ($surat->wasRecentlyCreated || $surat->wasChanged()) {
                    return redirect()->back()->with('success', 'File PDF berhasil diunggah dan disimpan ke database.');
                } else {
                    return redirect()->back()->with('error', 'Gagal menyimpan file PDF ke database.');
                }
            } else {
                // Handle case when the uploaded file is not a PDF
                return redirect()->back()->with('error', 'File yang diunggah bukan file PDF.');
            }
        } else {
            // Handle case when no file is uploaded
            return redirect()->back()->with('error', 'Tidak ada file yang diunggah.');
        }
    }

    public function lihatpdf($surat_id)
    {
        $surat = Surat::find($surat_id);
        if ($surat) {
            $filePath = $surat->file_path;
            if (file_exists($filePath)) {
                return Response::file($filePath, ['Content-Type' => 'application/pdf']);
            } else {
                return redirect('admin/infosurat')->with('error', 'File PDF tidak ditemukan.');
            }
        } else {
            return redirect('admin/infosurat')->with('error', 'Surat tidak ditemukan.');
        }
    }
    public function qrcode() 
    {

    }
}
