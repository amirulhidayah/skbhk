<?php

namespace App\Imports;

use App\Models\Karyawan;
use App\Models\MasterBranchFranchise;
use App\Models\MasterBranchRegulars;
use App\Models\Toko;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KaryawanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Tetapkan nilai default untuk bagian 11-14 jika kosong
        $nama = $row['nama'] ?? null;
        $tempat_lahir = $row['tempat_lahir'] ?? null;
        $tanggal_lahir = $row['tanggal_lahir'] ?? null;
        $pendidikan = $row['pendidikan'] ?? null;
        $jabatan = $row['jabatan'] ?? null;
        $branch = $row['branch'] ?? null;
        $no_surat = $row['no_surat'] ?? null;
        $tgl_awal_hubker = $row['tgl_awal_hubker'] ?? null;
        $tgl_akhir_hubker = $row['tgl_akhir_hubker'] ?? null;
        $jenis_pkwt = $row['jenis_pkwt'] ?? null;
        $no_pkwt = $row['no_pkwt'] ?? null;
        $tgl_pkwt = $row['tgl_pkwt'] ?? null;
        $nama_pt = $row['nama_pt'] ?? null;
        $nama_toko = $row['nama_toko'] ?? null;

        $masterBranchRegulars = MasterBranchRegulars::where('branch', $branch)->first();
        if (!$masterBranchRegulars) $masterBranchRegulars = new MasterBranchRegulars();
        $masterBranchRegulars->branch = $branch;
        $masterBranchRegulars->save();

        $masterBranchFranchise = MasterBranchFranchise::where('nama_pt', $nama_pt)->first();
        if (!$masterBranchFranchise) $masterBranchFranchise = new MasterBranchFranchise();
        $masterBranchFranchise->nama_pt = $nama_pt;
        $masterBranchFranchise->save();

        $toko = Toko::where('nama_toko', $nama_toko)->where('master_branch_franchises_id', $masterBranchFranchise->id)->first();
        if (!$toko) $toko = new Toko();
        $toko->nama_toko = $nama_toko;
        $toko->master_branch_franchises_id = $masterBranchFranchise->id;
        $toko->save();

        // Periksa keberadaan "nik" dalam array $row
        $nik = $row['nik'] ?? null;

        // Jika "nik" tidak ada, Anda mungkin perlu mengembalikan atau mengabaikan data ini
        if ($nik === null) {
            Log::error("Baris tidak memiliki kolom 'nik'. Data dilewati: " . json_encode($row));
            return null;
        }

        $karyawan = Karyawan::where('nik', rc4_encrypt($nik))->first();
        if (!$karyawan) $karyawan = new Karyawan();
        $karyawan->nik = rc4_encrypt($nik);
        $karyawan->nama =  $nama;
        $karyawan->tempat_lahir =  $tempat_lahir;
        $karyawan->tanggal_lahir = ($tanggal_lahir) ? Carbon::parse($tanggal_lahir)->format('Y-m-d') : null;
        $karyawan->pendidikan = $pendidikan;
        $karyawan->jabatan =  $jabatan;
        $karyawan->no_surat =  $no_surat;
        $karyawan->tgl_awal_hubker = isset($tgl_awal_hubker) ? Carbon::parse($tgl_awal_hubker)->format('Y-m-d') : null;
        $karyawan->tgl_akhir_hubker = isset($tgl_akhir_hubker) ? Carbon::parse($tgl_akhir_hubker)->format('Y-m-d') : null;
        $karyawan->jenis_pkwt = $jenis_pkwt;
        $karyawan->no_pkwt = $no_pkwt;
        $karyawan->tgl_pkwt = isset($tgl_pkwt) ? Carbon::parse($tgl_pkwt)->format('Y-m-d') : null;
        $karyawan->master_branch_regulars_id = $masterBranchRegulars?->id;
        $karyawan->master_branch_franchises_id = $masterBranchFranchise?->id;
        $karyawan->toko_id = $toko?->id;
        $karyawan->save();


        // // Gunakan updateOrInsert untuk memeriksa dan mengganti data berdasarkan NIK
        // Karyawan::updateOrInsert(['nik' => $nik], $data);
    }
}
