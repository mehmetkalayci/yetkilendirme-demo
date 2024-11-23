@extends('layouts.app')

@section('content')
    <h1>Rapor Düzenle</h1>

    <form action="{{ route('reports.update', $report) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input type="text" name="title" class="form-control" value="{{ $report->title }}" required>
        </div>
        <div class="mb-3">
            <textarea name="description" class="form-control" required>{{ $report->description }}</textarea>
        </div>
        
        <select name="post_id" class="form-select" required>
            <option value="">Post Seçin</option>
            @foreach ($posts as $post)
                <option value="{{ $post->id }}" {{ $post->id == $report->post_id ? 'selected' : '' }}>{{ $post->title }}</option>
            @endforeach
        </select>
        
        <button type="submit" class="btn btn-warning mt-3">Güncelle</button>
    </form>
@endsection
