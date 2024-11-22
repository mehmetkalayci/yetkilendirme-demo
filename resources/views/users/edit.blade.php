@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required>
        
        <label for="roles">Roles:</label>
        <select name="roles[]" id="roles" multiple>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        
        <label for="permissions">Permissions:</label>
        <select name="permissions[]" id="permissions" multiple>
            @foreach ($permissions as $permission)
                <option value="{{ $permission->id }}" {{ $user->permissions->contains($permission->id) ? 'selected' : '' }}>
                    {{ $permission->name }}
                </option>
            @endforeach
        </select>
        
        <button type="submit">Update User</button>
    </form>
@endsection
