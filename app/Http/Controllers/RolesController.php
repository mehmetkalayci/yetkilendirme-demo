<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class RolesController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-role')->only(['create', 'store']);
        $this->middleware('permission:edit-role')->only(['edit', 'update']);
        $this->middleware('permission:delete-role')->only(['destroy']);
    }

    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Role::create($request->all());
        return redirect()->route('roles.index')->with('success', 'Rol başarıyla oluşturuldu.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $role->update($request->all());
        return redirect()->route('roles.index')->with('success', 'Rol başarıyla güncellendi.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol başarıyla silindi.');
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate(['permissions' => 'array', 'permissions.*' => 'exists:permissions,id']);
        $role->permissions()->sync($request->permissions);
        return redirect()->route('roles.index')->with('success', 'İzinler başarıyla güncellendi.');
    }
} 