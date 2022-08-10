<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function destroy(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function profile() {
        $id = Auth::id();
        $userData = User::find($id);

        return view('admin.admin_profile_view', compact('userData'));
    }

    public function editProfile() {
        $id = Auth::id();
        $editData = User::find($id);

        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function storeProfile(Request $request) {
        $id = Auth::id();
        $userEdit = User::find($id);

        $userEdit->name = $request->name;
        $userEdit->username = $request->username;
        $userEdit->email = $request->email;

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');

            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $userEdit['profile_image'] = $fileName;
        }

        $userEdit->save();

        return redirect()->route('admin.profile');
    }
}
