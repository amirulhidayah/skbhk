<?php

namespace App\Http\Controllers\Admin;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Ambil tahun yang dipilih dari URL atau gunakan tahun saat ini jika tidak ada
            $selectedYear = $request->input('year', date('Y'));

            // Ambil data surat berdasarkan tahun yang dipilih
            $suratData = Surat::select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw("COUNT(*) as total")
            )
                ->whereYear('created_at', $selectedYear)
                ->groupBy(DB::raw("MONTH(created_at)"))
                ->orderBy(DB::raw("MONTH(created_at)"))
                ->get();

            // Hitung jumlah surat berdasarkan jenis
            $surat003 = Surat::where('jenis_surat', 'Choice 1')->count();
            $surat004 = Surat::where('jenis_surat', 'Choice 2')->count();
            $surat005 = Surat::where('jenis_surat', 'Choice 3')->count();
            $surat006 = Surat::where('jenis_surat', 'Choice 4')->count();
            $suratoffice = Surat::where('jenis_surat', 'Choice 1')->orWhere('jenis_surat', 'Choice 3')->count();
            $suratfranchise = Surat::where('jenis_surat', 'Choice 2')->orWhere('jenis_surat', 'Choice 4')->count();

            // Ambil tahun saat ini untuk default pada dropdown
            $currentYear = date('Y');

            return view('admin.dashboard', compact(
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
    
}; 
