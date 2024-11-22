@extends('layouts.app')

@section('content')
    <h1>Permissions</h1>
    <a href="{{ route('permissions.create') }}">Create Permission</a>
    <ul>
        @foreach ($permissions as $permission)
            <li>
                {{ $permission->name }}
                <a href="{{ route('permissions.edit', $permission) }}">Edit</a>
                <form action="{{ route('permissions.destroy', $permission) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection