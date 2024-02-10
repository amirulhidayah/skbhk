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
            $userBranch = auth()->user()->branch;
            // Ambil data surat berdasarkan tahun yang dipilih
            $suratData = Surat::select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw("COUNT(*) as total")
            )
                ->whereYear('created_at', $selectedYear)
                ->groupBy(DB::raw("MONTH(created_at)"))
                ->orderBy(DB::raw("MONTH(created_at)"))
                ->where('group_employee', $userBranch)
                ->get();

            // Hitung jumlah surat berdasarkan jenis
            $surat003 = Surat::where('jenis_surat', 'Choice 1')->where('group_employee', $userBranch)->count();
            $surat004 = Surat::where('jenis_surat', 'Choice 2')->where('group_employee', $userBranch)->count();
            $surat005 = Surat::where('jenis_surat', 'Choice 3')->where('group_employee', $userBranch)->count();
            $surat006 = Surat::where('jenis_surat', 'Choice 4')->where('group_employee', $userBranch)->count();
            $suratoffice = Surat::whereIn('jenis_surat', ['Choice 1', 'Choice 3'])
                ->where('group_employee', $userBranch)
                ->count();
            $suratfranchise = Surat::whereIn('jenis_surat', ['Choice 2', 'Choice 4'])
                ->where('group_employee', $userBranch)
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
        $masterBranchRegulers = MasterBranchReguler::where('status', 1)->get();
        return view('user.editprofile', compact('user', 'masterBranchRegulers'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:100',
            'branch' => 'required|string',
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
        $user->branch = $request->input('branch');
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
        $userBranch = auth()->user()->branch;

        // Mendapatkan data surat berdasarkan branch pengguna
        $surat = Surat::where('group_employee', $userBranch)->get();

        return view('user.surat.infosurat', compact('surat'));
    }
    public function indexsurat(Request $request)
    {
        $userBranch = auth()->user()->branch;
        // Debugging untuk memeriksa nilai branch yang diambil
        // dd($userBranch);
        $masterTtd = MasterTtd::where('branch', $userBranch)->get();
        // $masterTtd = MasterTtd::all();
        $employee = [];
        if ($request->has('karyawan_nik')) {
            $karyawan_nik = $request->input('karyawan_nik');
            $employee = Karyawan::where('nik', $karyawan_nik)->first();
            if (!$employee) {
                // Lakukan tindakan atau tampilkan pesan sesuai kebutuhan
                return redirect('/surat')->with('error', 'Data karyawan tidak ditemukan.');
            }
            if ($employee && $employee->group_employee !== $userBranch) {
                // Lakukan tindakan atau tampilkan pesan sesuai kebutuhan
                return redirect('/surat')->with('error', 'Data karyawan tidak ditemukan untuk branch Anda.');
            }
        }

        return view('user.surat.indexsurat', compact('employee', 'masterTtd'));
    }
    // public function search(Request $request)
    // {
    //     // Mengambil branch dari user saat ini
    //     $userBranch = auth()->user()->branch;



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
            'nik' => [
                'required',
                'string',
                'max:8'
            ],
            'nama' => [
                'required',
                'string',
                'max:100'
            ],
            'tempat_lahir' => [
                'required',
                'string',
            ],
            'tanggal_lahir' => [
                'required',
                'date',
            ],
            'pendidikan' => [
                'required',
                'string',
            ],
            'jabatan' => [
                'required',
                'string',
            ],
            'group_employee' => [
                'required',
                'string',
            ],
            'no_surat' => [
                'required',
                'string',
            ],
            'tgl_awal_hubker' => [
                'required',
                'date'
            ],
            'tgl_akhir_hubker' => [
                'nullable',
                'date',
            ],
            'alasan' => [
                'required',
                'string',
            ],
            'jabatan_ttd' => [
                'required',
                'string',
            ],
            'jenis_surat' => [
                'required',
                'string',
            ],
            'jenis_pkwt' => [
                'nullable',
                'string',
            ],
            'no_pkwt' => [
                'nullable',
                'string',
            ],
            'tgl_pkwt' => [
                'nullable',
                'string',
            ],
            'nama_pt' => [
                'nullable',
                'string'
            ],
            'nama_toko' => [
                'nullable',
                'string'
            ]
        ]);


        // Simpan data surat ke database
        $data = $validatedData;
        $user_id = auth()->user()->id;
        $surat = new Surat;
        $surat->nik = $data['nik'];
        $surat->nama = $data['nama'];
        $surat->tempat_lahir = $data['tempat_lahir'];
        $surat->tanggal_lahir = $data['tanggal_lahir'];
        $surat->pendidikan = $data['pendidikan'];
        $surat->jabatan = $data['jabatan'];
        $surat->group_employee = $data['group_employee'];
        $surat->nama_pt = $data['nama_pt'];
        $surat->no_surat = $data['no_surat'];
        $surat->tgl_awal_hubker = $data['tgl_awal_hubker'];
        $surat->tgl_akhir_hubker = $data['tgl_akhir_hubker'];
        $surat->alasan = $data['alasan'];
        $surat->jenis_surat = $data['jenis_surat'];
        $surat->user_id = $user_id;
        $surat->jabatan_ttd = $data['jabatan_ttd'];
        $surat->jenis_pkwt = $data['jenis_pkwt'];
        $surat->no_pkwt = $data['no_pkwt'];
        $surat->tgl_pkwt = $data['tgl_pkwt'];
        $surat->tgl_pkwt = $data['tgl_pkwt'];

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
        $surat = Surat::with('ptcv')->find($surat_id);
        $surat = Surat::with('toko')->find($surat_id);


        if ($surat) {
            $surat->load('branch');
            $surat->load('namattd');
            $surat->load('ptcv');
            $surat->load('toko');
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
        $userBranch = auth()->user()->branch;
        // $masterTtd = MasterTtd::all();
        $masterTtd = MasterTtd::where('branch', $userBranch)->get();
        $masterbranchregulers = MasterBranchReguler::where('status', 1)->get();
        $masterbranchfranchise = MasterBranchFranchise::all();
        return view('user.surat.editsurat', compact('surat', 'masterTtd', 'masterbranchregulers', 'masterbranchfranchise'));
    }
    public function updatesurat(Request $request, $surat_id)
    { {
            $validatedData = $request->validate([
                'nik' => [
                    'required',
                    'string',
                    'max:8'
                ],
                'nama' => [
                    'required',
                    'string',
                    'max:100'
                ],
                'tempat_lahir' => [
                    'required',
                    'string',
                ],
                'tanggal_lahir' => [
                    'required',
                    'date',
                ],
                'pendidikan' => [
                    'required',
                    'string',
                ],
                'jabatan' => [
                    'required',
                    'string',
                ],
                'group_employee' => [
                    'required',
                    'string',
                ],
                'nama_pt' => [
                    'nullable',
                    'string'
                ],
                'nama_toko' => [
                    'nullable',
                    'string'
                ],
                'no_surat' => [
                    'required',
                    'string',
                ],
                'tgl_awal_hubker' => [
                    'required',
                    'date'
                ],
                'tgl_akhir_hubker' => [
                    'nullable',
                    'date',
                ],
                'alasan' => [
                    'required',
                    'string',
                ],
                'jabatan_ttd' => [
                    'required',
                    'string',
                ],
                'jenis_surat' => [
                    'required',
                    'string',
                ],
                'jenis_pkwt' => [
                    'nullable',
                    'string',
                ],
                'no_pkwt' => [
                    'nullable',
                    'string',
                ],
                'tgl_pkwt' => [
                    'nullable',
                    'string',
                ],
            ]);


            // Simpan data surat ke database
            $data = $validatedData;
            $user_id = auth()->user()->id;
            $surat = Surat::find($surat_id);
            $surat->editor_id = auth()->user()->id;
            $surat->nik = $data['nik'];
            $surat->nama = $data['nama'];
            $surat->tempat_lahir = $data['tempat_lahir'];
            $surat->tanggal_lahir = $data['tanggal_lahir'];
            $surat->pendidikan = $data['pendidikan'];
            $surat->jabatan = $data['jabatan'];
            $surat->nama_pt = $data['nama_pt'];
            $surat->nama_toko = $data['nama_toko'];
            $surat->group_employee = $data['group_employee'];
            $surat->no_surat = $data['no_surat'];
            $surat->tgl_awal_hubker = $data['tgl_awal_hubker'];
            $surat->tgl_akhir_hubker = $data['tgl_akhir_hubker'];
            $surat->alasan = $data['alasan'];
            $surat->jenis_surat = $data['jenis_surat'];
            $surat->user_id = $user_id;
            $surat->jabatan_ttd = $data['jabatan_ttd'];
            $surat->jenis_pkwt = $data['jenis_pkwt'];
            $surat->no_pkwt = $data['no_pkwt'];
            $surat->tgl_pkwt = $data['tgl_pkwt'];
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
