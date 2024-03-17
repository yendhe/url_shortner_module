@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <a href="{{ url('/shorten') }}" class="btn btn-primary">Add Urls Here</a>
                    <a href="{{ url('/upgrade') }}" class="btn btn-warning">Upgrade Plans</a>
                </div>
            </div>
        </div>
    </div>
</div>
</br>
<div class="container">
    <h4>Listing</h4>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Original URL</th>
                <th>Shortened URL</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shortenedUrls as $url)
            <tr @if ($url->deactivated) class="alert alert-danger" @endif>

                <td>{{ $loop->iteration }}</td>
                <td>{{ $url->original_url }}</td>
                <td>{{ $url->short_code }}</td>
                <td>
                    <form action="{{ route('deactivate', ['id' => $url->id]) }}" method="POST">
                        @csrf
                        @if ($url->deactivated)
                        Deactivated
                        @else
                        <button type="submit" class="btn btn-warning">Deactivate</button>
                        @endif
                        
                    </form>
                </td>
                <td>
                    <form action="{{ route('destroy', ['id' => $url->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('edit', ['id' => $url->id]) }}" class="btn btn-primary">Edit</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection