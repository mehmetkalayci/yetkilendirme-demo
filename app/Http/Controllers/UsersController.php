<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;

class UsersController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user')->only(['create', 'store']);
        $this->middleware('permission:edit-user')->only(['edit', 'update']);
        $this->middleware('permission:delete-user')->only(['destroy']);
    }

    public function create()
    {
        $roles = Role::all(); // Tüm rolleri al
        $permissions = Permission::all(); // Tüm izinleri al
        return view('users.create', compact('roles', 'permissions')); // İzinleri view'a gönder
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'array',
            'permissions' => 'array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Kullanıcıya roller atama
        if ($request->roles) {
            $user->roles()->attach($request->roles);
        }

        // Kullanıcıya izin atama
        if ($request->permissions) {
            $user->permissions()->attach($request->permissions);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all(); // Tüm rolleri al
        $permissions = Permission::all(); // Tüm izinleri al
        return view('users.edit', compact('user', 'roles', 'permissions')); // İzinleri view'a gönder
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'roles' => 'array',
            'permissions' => 'array',
        ]);

        $user->update($request->only('name', 'email'));

        // Kullanıcı rollerini güncelle
        $user->roles()->sync($request->roles);

        // Kullanıcı izinlerini güncelle
        if ($request->permissions) {
            $user->permissions()->sync($request->permissions);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function index()
    {
        $users = User::with('roles')->get(); // Kullanıcıları ve rollerini al
        return view('users.index', compact('users')); // Kullanıcıları view'a gönder
    }
}
