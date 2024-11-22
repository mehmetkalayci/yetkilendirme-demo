@extends('layouts.app')

@section('content')
<h1>Admin Panel</h1>
<nav>
    <ul>
        <li><a href="{{ route('users.index') }}">Users</a></li>
        <li><a href="{{ route('roles.index') }}">Roles</a></li>
        <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
        <li><a href="{{ route('posts.index') }}">Posts</a></li>
        <li><a href="{{ route('reports.index') }}">Reports</a></li>
        <li>{{ auth()->user()->name }}</li>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </ul>
</nav>
@endsection