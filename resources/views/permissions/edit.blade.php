@extends('layouts.app')

@section('content')
    <h1>Edit Permission</h1>
    <form action="{{ route('permissions.update', $permission) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Permission Name:</label>
        <input type="text" name="name" id="name" value="{{ $permission->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection