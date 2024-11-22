@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    @can('create', App\Models\Post::class)
        <a href="{{ route('posts.create') }}">Create Post</a>
    @endcan

    <ul>
        @foreach ($posts as $post)
            <li>
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>

                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}">Edit</a>
                @endcan

                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endcan
            </li>
        @endforeach
    </ul>
@endsection
