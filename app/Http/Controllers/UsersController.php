<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use App\Role;

class UsersController extends Controller
{
    public function Index() {
        $users = User::all();
        
        return view('home.users.index', compact('users'));
    }

    public function NewUser() {
        $department = Department::all();
        $role = Role::all();
        return view('home.users.new', compact('department', 'role'));
    }

    public function AddNewUser(Request $request) {
        $request->validate([
            'familiya'=>'required',
            'imya'=>'required',
            'otchestvo'=>'required',
            'username'=>'required|min:3',
            'password'=>'required|min:3|confirmed',
            'department'=>'required',
            'role'=>'required'
        ]);
        $user = new User();

        $user->familiya = $request->familiya;
        $user->imya = $request->imya;
        $user->otchestvo = $request->otchestvo;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->department_id = $request->department;
        $user->save();

        $user->roles()->attach($request->role); // добавление роли пользователю
        return redirect()->route('users')->with('success', 'Пользователь успешно создан!');
    }

    public function Delete($id) {
        $user = User::find($id);
        foreach ($user->roles as $role) {
            $user->roles()->detach($role->id);
        }
        $user->delete();
        return redirect()->back()->with('success', 'Пользователь успешно удален!');
    }
}
