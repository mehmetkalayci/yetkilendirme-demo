@extends('layouts.app')

@section('content')
    <h1>Permissions</h1>
    @if(auth()->user()->hasPermission('create-permission'))
        <a href="{{ route('permissions.create') }}">Create Permission</a>
    @endif
    <ul>
        @foreach ($permissions as $permission)
            <li>
                {{ $permission->name }}
                @if(auth()->user()->hasPermission('edit-permission'))
                    <a href="{{ route('permissions.edit', $permission) }}">Edit</a>
                @endif
                @if(auth()->user()->hasPermission('delete-permission'))
                    <form action="{{ route('permissions.destroy', $permission) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
@endsection