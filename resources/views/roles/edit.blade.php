@extends('layouts.app')

@section('content')
    <h1>Edit Role</h1>
    <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Role Name:</label>
        <input type="text" name="name" id="name" value="{{ $role->name }}" required>
        <button type="submit">Update</button>
    </form>

    <h2>Assign Permissions</h2>
    <form action="{{ route('roles.permissions', $role) }}" method="POST">
        @csrf
        <select name="permissions[]" multiple>
            @foreach ($permissions as $permission)
                <option value="{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'selected' : '' }}>
                    {{ $permission->name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Assign Permissions</button>
    </form>
@endsection