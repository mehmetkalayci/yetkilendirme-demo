@extends('layouts.app')

@section('content')
    <h1>Reports</h1>
    
    @if(auth()->user()->hasPermission('create-report'))
        <form action="{{ route('reports.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <input type="text" name="title" class="form-control" placeholder="Rapor Başlığı" required>
            </div>
            <div class="mb-3">
                <textarea name="description" class="form-control" placeholder="Rapor Açıklaması" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Oluştur</button>
        </form>
    @endif

    <ul class="list-group">
        @foreach ($reports as $report)
            <li class="list-group-item">
                <h2>{{ $report->title }}</h2>
                <p>{{ $report->description }}</p>
                @if(auth()->user()->hasPermission('edit-report'))
                    <a href="{{ route('reports.edit', $report) }}" class="btn btn-warning">Düzenle</a>
                @endif
                @if(auth()->user()->hasPermission('delete-report'))
                    <form action="{{ route('reports.destroy', $report) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Sil</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
@endsection
