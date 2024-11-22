@extends('layouts.app')

@section('content')
    <h1>Create Permission</h1>
    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <label for="name">Permission Name:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Create</button>
    </form>
@endsection