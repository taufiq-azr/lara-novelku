<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UsersPage()
    {
        $users = Users::all();

        return view('admin.users', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = new Users();
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));

        if ($user->save()) {
            return redirect()->route('admin.users')->with('status', 'success');
        } else {
            return redirect()->route('admin.users')->with('status', 'error')->with('message', 'Failed to store user');
        }
    }

    public function delete($id)
    {
        $user = Users::findOrFail($id);

        if ($user->delete()) {
            return redirect()->route('admin.users')->with('status', 'success');
        } else {
            return redirect()->route('admin.users')->with('status', 'error')->with('message', 'Failed to delete user');
        }
    }

    public function update(Request $request)
    {
        $userId = $request->input('user-modal-id');

        if (!$userId) {
            return redirect()->route('admin.users')->with('status', 'error')->with('message', 'User ID not found');
        }

        $user = Users::findOrFail($userId);

        $password = $request->input('user-modal-password');
        $confirmPassword = $request->input('confirm-password-modal');

        if ($password !== $confirmPassword) {
            return redirect()->route('admin.users')->with('error_message', 'Passwords do not match');
        }

        $user->email = $request->input('user-modal-email');
        $user->username = $request->input('modal-username');
        $user->password = bcrypt($password);

        if ($user->save()) {
            return redirect()->route('admin.users')->with('status', 'success');
        } else {
            return redirect()->route('admin.users')->with('status', 'error')->with('message', 'Failed to update user');
        }
    }
}
