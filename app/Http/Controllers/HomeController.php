<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Karyawan;
use Barryvdh\DomPDF\PDF;
use App\Models\MasterTtd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterBranchReguler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MasterBranchFranchise;
use App\Models\MasterBranchRegulars;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        try {
            // Ambil tahun yang dipilih dari URL atau gunakan tahun saat ini jika tidak ada
            $selectedYear = $request->input('year', date('Y'));
            $userBranch = auth()->user()->master_branch_regulars_id;
            // Ambil data surat berdasarkan tahun yang dipilih
            $suratData = Surat::select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw("COUNT(*) as total")
            )
                ->whereYear('created_at', $selectedYear)
                ->groupBy(DB::raw("MONTH(created_at)"))
                ->orderBy(DB::raw("MONTH(created_at)"))
                ->whereHas('karyawan', function ($query) use ($userBranch) {
                    $query->where('master_branch_regulars_id', $userBranch);
                })
                ->get();

            // Hitung jumlah surat berdasarkan jenis
            $surat003 = Surat::where('jenis_surat', 'Choice 1')->whereHas('karyawan', function ($query) use ($userBranch) {
                $query->where('master_branch_regulars_id', $userBranch);
            })->count();
            $surat004 = Surat::where('jenis_surat', 'Choice 2')->whereHas('karyawan', function ($query) use ($userBranch) {
                $query->where('master_branch_regulars_id', $userBranch);
            })->count();
            $surat005 = Surat::where('jenis_surat', 'Choice 3')->whereHas('karyawan', function ($query) use ($userBranch) {
                $query->where('master_branch_regulars_id', $userBranch);
            })->count();
            $surat006 = Surat::where('jenis_surat', 'Choice 4')->whereHas('karyawan', function ($query) use ($userBranch) {
                $query->where('master_branch_regulars_id', $userBranch);
            })->count();
            $suratoffice = Surat::whereIn('jenis_surat', ['Choice 1', 'Choice 3'])
                ->whereHas('karyawan', function ($query) use ($userBranch) {
                    $query->where('master_branch_regulars_id', $userBranch);
                })
                ->count();
            $suratfranchise = Surat::whereIn('jenis_surat', ['Choice 2', 'Choice 4'])
                ->whereHas('karyawan', function ($query) use ($userBranch) {
                    $query->where('master_branch_regulars_id', $userBranch);
                })
                ->count();

            // Ambil tahun saat ini untuk default pada dropdown
            $currentYear = date('Y');

            return view('user.home', compact(
                'surat003',
                'surat004',
                'surat005',
                'surat006',
                'suratoffice',
                'suratfranchise',
                'suratData',
                'selectedYear',
                'currentYear'
            ));
        } catch (\Exception $e) {
            // Tangani pengecualian (log atau tampilkan pesan kesalahan)
            dd($e->getMessage());
        }
    }
    public function edit()
    {
        $user = Auth::user();
        $masterBranchRegulers = MasterBranchRegulars::where('status', 1)->get();
        return view('user.editprofile', compact('user', 'masterBranchRegulers'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:100',
            'master_branch_regulars_id' => 'required|string',
            'email' => 'required|string|email|max:100|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|required_with:new_password',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // If the password is provided, validate it
        if ($request->filled('password')) {
            // Validate old password
            if (!Hash::check($request->input('password'), $user->password)) {
                return redirect()->back()->with('error', 'Password lama tidak cocok.');
            }

            // If the new password is provided, update it
            if ($request->filled('new_password')) {
                $user->password = Hash::make($request->input('new_password'));
            }
        }

        // Update other user data
        $user->name = $request->input('name');
        $user->master_branch_regulars_id = $request->input('master_branch_regulars_id');
        $user->email = $request->input('email');

        if ($user->save()) {
            return redirect('/editprofile')->with('success', 'Profil berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
    }
    public function infosurat()
    {
        // Mendapatkan branch pengguna yang sedang login
        $userBranch = auth()->user()->master_branch_regulars_id;
        // Mendapatkan data surat berdasarkan branch pengguna
        $surat = Surat::whereHas('karyawan', function ($query) use ($userBranch) {
            $query->where('master_branch_regulars_id', $userBranch);
        })->get();

        return view('user.surat.infosurat', compact('surat'));
    }
    public function indexsurat(Request $request)
    {
        $userBranch = auth()->user()->master_branch_regulars_id;
        // Debugging untuk memeriksa nilai branch yang diambil
        // dd($userBranch);
        $masterTtd = MasterTtd::where('master_branch_regulars_id', $userBranch)->get();
        // $masterTtd = MasterTtd::all();
        $employee = [];
        if ($request->has('karyawan_nik')) {
            $karyawan_nik = $request->input('karyawan_nik');
            $employee = Karyawan::where('nik', rc4_encrypt($karyawan_nik))->first();
            if (!$employee) {
                // Lakukan tindakan atau tampilkan pesan sesuai kebutuhan
                return redirect('/surat')->with('error', 'Data karyawan tidak ditemukan.');
            }
            if ($employee && $employee->master_branch_regulars_id !== $userBranch) {
                // Lakukan tindakan atau tampilkan pesan sesuai kebutuhan
                return redirect('/surat')->with('error', 'Data karyawan tidak ditemukan untuk branch Anda.');
            }
        }

        return view('user.surat.indexsurat', compact('employee', 'masterTtd'));
    }
    // public function search(Request $request)
    // {
    //     // Mengambil branch dari user saat ini
    //     $userBranch = auth()->user()->master_branch_regulars_id;



    //     $employee = null;

    //     if ($request->has('karyawan_nik')) {
    //         $karyawan_nik = $request->input('karyawan_nik');

    //         // Menambahkan kondisi where untuk memfilter berdasarkan branch
    //         $employee = Karyawan::where('nik', $karyawan_nik)
    //             ->where('group_employee', $userBranch)
    //             ->first();
    //         // Menambahkan kondisi jika group_employee tidak sama dengan branch user
    //         if ($employee && $employee->group_employee !== $userBranch) {
    //             // Lakukan tindakan atau tampilkan pesan sesuai kebutuhan
    //             return redirect('/surat')->with('error', 'Data karyawan tidak ditemukan untuk branch Anda.');
    //         }
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
            return redirect('/infosurat')->with('success', 'SKBHK Berhasil Ditambahkan');
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
                $pdf = app('dompdf.wrapper')->loadView('user.surat.myPDF', $data);
                $fileName = "Surat SKBHK $surat->nama.pdf";
                // Tambahkan kondisi lain berdasarkan jenis surat dan alasan yang sesuai
            } elseif ($surat->jenis_surat === 'Choice 2' || $surat->jenis_surat === 'Choice 4') {
                // Logika untuk jenis surat pertama dan alasan pertama
                $pdf = app('dompdf.wrapper')->loadView('user.surat.myPDF2', $data);
                $fileName = "Surat SKBHK $surat->nama.pdf";
            }
            if ($pdf) {
                return $pdf->download($fileName);
                return view('user.surat.print', compact('pdf', 'fileName'));
            } else {
                return redirect('/infosurat')->with('error', 'Tidak ada PDF yang sesuai untuk jenis surat ini.');
            }
        } else {
            return redirect('/infosurat')->with('error', 'Surat tidak ditemukan.');
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
                $pdf = app('dompdf.wrapper')->loadView('user.surat.myPDF', $data);
                $fileName = "Surat SKBHK $surat->nama.pdf";
                // Tambahkan kondisi lain berdasarkan jenis surat dan alasan yang sesuai
            } elseif ($surat->jenis_surat === 'Choice 2' || $surat->jenis_surat === 'Choice 4') {
                // Logika untuk jenis surat pertama dan alasan pertama
                $pdf = app('dompdf.wrapper')->loadView('user.surat.myPDF2', $data);
                $fileName = "Surat SKBHK $surat->nama.pdf";
            }

            if ($pdf) {
                // Menampilkan tampilan PDF langsung
                return view('user.surat.print', compact('pdf', 'fileName'));
            } else {
                return redirect('/infosurat')->with('error', 'Tidak ada PDF yang sesuai untuk jenis surat ini.');
            }
        } else {
            return redirect('/infosurat')->with('error', 'Surat tidak ditemukan.');
        }
    }

    public function editsurat($surat_id)
    {
        $surat =  Surat::find($surat_id);
        $employee = $surat->karyawan;
        $userBranch = auth()->user()->master_branch_regulars_id;
        // $masterTtd = MasterTtd::all();
        $masterTtd = MasterTtd::where('master_branch_regulars_id', $userBranch)->get();
        $masterbranchregulers = MasterBranchRegulars::where('status', 1)->get();
        $masterbranchfranchise = MasterBranchFranchise::all();
        return view('user.surat.editsurat', compact('surat', 'masterTtd', 'masterbranchregulers', 'masterbranchfranchise', 'employee'));
    }
    public function updatesurat(Request $request, $surat_id)
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
                return redirect('/infosurat')->with('success', 'Data Surat Berhasil Diedit');
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
            return redirect('/infosurat')->with('success', 'Surat Berhasil Dihapus');
        } else {
            return redirect('/infosurat')->with('success', 'Surat tidak ditemukan');
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
                $surat->file_path = $destinationPath . '/' . $filename;
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
}
