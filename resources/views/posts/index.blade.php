@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    @if(auth()->user()->hasPermission('create-post'))
        <a href="{{ route('posts.create') }}">Create Post</a>
    @endif

    <ul>
        @foreach ($posts as $post)
            <li>
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>

                @if(auth()->user()->hasPermission('edit-post'))
                    <a href="{{ route('posts.edit', $post) }}">Edit</a>
                @endif

                @if(auth()->user()->hasPermission('delete-post'))
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
@endsection
