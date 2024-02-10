<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MasterBranchReguler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditprofilController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $masterBranchRegulers = MasterBranchReguler::where('status', 1)->get();
        return view('admin.editprofil', compact('user', 'masterBranchRegulers'));
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
        return redirect('admin/editprofil')->with('success', 'Profil berhasil diperbarui!');
    } else {
        return redirect()->back()->with('error', 'Gagal menyimpan data.');
    }
}
    public function destroy($masteruser_id)
    {
        $masteruser = User::find($masteruser_id);
        if ($masteruser) {
            $masteruser->delete();
            return redirect('admin/masteruser')->with('success', 'User Berhasil Dihapus');
        } else {
            return redirect('admin/masteruser')->with('error', 'User tidak ditemukan');
        }
    }
    public $delete_id;
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
}
