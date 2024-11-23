@extends('layouts.app')

@section('content')
    <h1>Roles</h1>
    @if(auth()->user()->hasPermission('create-role'))
        <a href="{{ route('roles.create') }}">Create Role</a>
    @endif
    <ul>
        @foreach ($roles as $role)
            <li>
                {{ $role->name }}
                <a href="{{ route('roles.edit', $role) }}">Edit</a>
                <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
