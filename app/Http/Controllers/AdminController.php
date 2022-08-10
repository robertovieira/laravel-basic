<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Usuário desconectado com sucesso',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
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

        $notification = array(
            'message' => 'Perfil atualizado com sucesso',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function changePassword() {
        return view('admin.admin_change_password');
    }

    public function updatePassword(Request $request) {
        $validateData = $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);

        $hasHedPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hasHedPassword)) {
            $user = User::find(Auth::id());
            $user->password = $request->new_password;
            $user->save();

            session()->flash('message', 'Senha alterada com sucesso');
            return redirect()->back();
        } else {
            session()->flash('message', 'A senha atual está incorreta');
            return redirect()->back();
        }
    }
}
