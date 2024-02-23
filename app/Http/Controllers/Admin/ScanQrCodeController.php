<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Exception;
use Illuminate\Http\Request;

class ScanQrCodeController extends Controller
{
    public function index()
    {
        return view('admin.scanqrcode.index');
    }

    public function scanResult(Request $request)
    {
        try {
            $qrData = $request->qrdata;
            $splitData = explode("-", $qrData);
            $id = $splitData[1];
            $surat = Surat::with(['user', 'karyawan'])->where('id', $id)->first();

            if ($surat->jenis_surat == 'Choice 1') {
                $jenisSurat = 'SKBHK 003';
            } elseif ($surat->jenis_surat == 'Choice 2') {
                $jenisSurat = 'SKBHK 004';
            } elseif ($surat->jenis_surat == 'Choice 3') {
                $jenisSurat = 'SKBHK 005';
            } elseif ($surat->jenis_surat == 'Choice 4') {
                $jenisSurat = 'SKBHK 005';
            }

            return response()->json([
                'data' => $surat,
                'jenis_surat' => $jenisSurat
            ]);
        } catch (Exception $exception) {
            return throw $exception;
        }
    }
}
