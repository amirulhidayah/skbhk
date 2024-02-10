<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $surat = Surat::get();
  
        $data = [
            'title' => 'Surat SKBHK',
            'surat' => $surat
        ]; 
            
        $pdf = PDF::loadView('admin.surat.myPDF', $data);
    
        return $pdf->download('SKBHK.pdf');
    }
}

