@extends('layouts.app')

@section('content')
    <h1>Users</h1>
    <pre class="bg-light p-3 rounded text-dark h-100">
    {{auth()->user()->permissions}}
    </pre>
    <strong>{{auth()->user()->hasPermission('create-user') ? 'true' : 'false'}}</strong>
    @if(auth()->user()->hasPermission('create-user'))
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create User</a>
    @endif
    <ul class="list-group">
        @foreach ($users as $user)
            <li class="list-group-item">
                {{ $user->name }} ({{ $user->email }})
                @if(auth()->user()->hasPermission('edit-user'))
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Edit</a>
                @endif
                @if(auth()->user()->hasPermission('delete-user'))
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
@endsection
