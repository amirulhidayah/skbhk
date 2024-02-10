<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MasterBranchReguler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\MasterUserRequest;
use App\Http\Requests\Admin\MasterUserEditRequest;
use App\Models\MasterBranchRegulars;

class MasterUserController extends Controller
{
    public function index()
    {
        $masteruser = User::all();
        return view('admin.masteruser.index', compact('masteruser'));
    }
    public function create()
    {
        $masterBranchRegulars = MasterBranchRegulars::where('status', 1)->get();
        return view('admin.masteruser.create', compact('masterBranchRegulars'));
    }
    public function store(MasterUserRequest $request)
    {
        $data = $request->validated();

        $masteruser = new User;
        $masteruser->name = $data['name'];
        $masteruser->master_branch_regulars_id = $data['master_branch_regulars_id'];
        $masteruser->email = $data['email'];
        $masteruser->password = $data['password'];
        $masteruser->role_as = $data['role_as'];

        // Atur super admin utama
        if ($data['role_as'] === 'super_admin' && User::where('role_as', 'super_admin')->count() === 0) {
            $masteruser->is_main_super_admin = true;
        }

        $masteruser->save();
        return redirect('admin/masteruser')->with('success', 'User Berhasil Ditambahkan');
    }
    public function edit($masteruser_id)
    {
        $masteruser = User::find($masteruser_id);
        $masterbranchregulars = MasterBranchRegulars::where('status', 1)->get();
        return view('admin.masteruser.edit', compact('masteruser', 'masterbranchregulars'));
    }
    public function update(MasterUserEditRequest $request, $masteruser_id)
    {
        $data = $request->validated();
        $masteruser = User::find($masteruser_id);

        $masteruser->name = $data['name'];
        $masteruser->master_branch_regulars_id = $data['master_branch_regulars_id'];
        $masteruser->email = $data['email'];
        $masteruser->role_as = $data['role_as'];

        // Update password only if it's provided
        if ($request->filled('password')) {
            $masteruser->password = Hash::make($request->input('password'));
        }
        if ($masteruser->is_main_super_admin) {
            return redirect('admin/masteruser')->with('error', 'Super Admin utama tidak dapat diedit');
        }
        if ($masteruser->save()) {
            return redirect('admin/masteruser')->with('success', 'Profil berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
    }

    public function destroy($masteruser_id)
    {
        // $superAdminId = 1; // ID super admin utama

        $masteruser = User::find($masteruser_id);

        if (!$masteruser) {
            return redirect('admin/masteruser')->with('error', 'User tidak ditemukan');
        }

        // Pastikan super admin utama tidak dapat dihapus
        if ($masteruser->is_main_super_admin) {
            return redirect('admin/masteruser')->with('error', 'Super Admin utama tidak dapat dihapus');
        }

        // Hapus pengguna lainnya
        $masteruser->delete();

        return redirect('admin/masteruser')->with('success', 'User Berhasil Dihapus');
    }

    public $delete_id;
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
}
