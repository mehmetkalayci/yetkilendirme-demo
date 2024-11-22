@extends('layouts.app')

@section('content')
    <h1>Reports</h1>
    <ul>
        @foreach ($reports as $report)
            <li>
                <h2>{{ $report->title }}</h2>
                <p>{{ $report->description }}</p>
                <a href="{{ route('reports.edit', $report) }}">Edit</a>
                <form action="{{ route('reports.destroy', $report) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
