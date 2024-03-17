@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Shortened URL</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('update', ['id' => $shortenedUrl->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="original_url">Original URL</label>
                <input type="text" class="form-control" id="original_url" name="original_url" value="{{ old('original_url', $shortenedUrl->original_url) }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ url('/home') }}" class="btn btn-primary">Back</a>
        </form>
    </div>
@endsection
