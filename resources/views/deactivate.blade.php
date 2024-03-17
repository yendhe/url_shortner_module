@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Deactivate Shortened URL</h1>
        <form action="{{ route('deactivate', ['id' => $shortenedUrl->id]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to deactivate this URL?')">Deactivate</button>
        </form>
    </div>
@endsection