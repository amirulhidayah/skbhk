<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function toko(Request $request)
    {
        $id = $request->id;
        $data = Toko::where('master_branch_franchises_id', $id)->orderBy('nama_toko', 'asc')->get();

        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
