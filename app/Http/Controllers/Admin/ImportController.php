<!-- <?php

        namespace App\Http\Controllers\Admin;

        use Illuminate\Http\Request;
        use App\Imports\KaryawanImport;
        use App\Http\Controllers\Controller;
        use Maatwebsite\Excel\Facades\Excel;

        class ImportController extends Controller
        {
            public function import()
            {
                Excel::import(new KaryawanImport, request()->file('file'));

                return redirect('admin/masterkaryawan')->with('success', 'Data Karyawan Berhasil Diimport');
            }
        }
