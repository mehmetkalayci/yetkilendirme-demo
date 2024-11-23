<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PermissionsController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-permission')->only(['create', 'store']);
        $this->middleware('permission:edit-permission')->only(['edit', 'update']);
        $this->middleware('permission:delete-permission')->only(['destroy']);
    }

    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Permission::create($request->all());
        return redirect()->route('permissions.index')->with('success', 'İzin başarıyla oluşturuldu.');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $permission->update($request->all());
        return redirect()->route('permissions.index')->with('success', 'İzin başarıyla güncellendi.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'İzin başarıyla silindi.');
    }
}