@extends('layouts.app')

@section('content')
    <h1>Rapor Oluştur</h1>

    <form action="{{ route('reports.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="text" name="title" class="form-control" placeholder="Rapor Başlığı" required>
        </div>
        <div class="mb-3">
            <textarea name="description" class="form-control" placeholder="Rapor Açıklaması" required></textarea>
        </div>
        
        <select name="post_id" class="form-select" required>
            <option value="">Post Seçin</option>
            @foreach ($posts as $post)
                <option value="{{ $post->id }}">{{ $post->title }}</option>
            @endforeach
        </select>
        
        <button type="submit" class="btn btn-primary mt-3">Oluştur</button>
    </form>
@endsection
