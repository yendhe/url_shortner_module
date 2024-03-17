@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('upgrade') }}" method="POST">
                        @csrf
                        <label for="plan">Select Plan:</label>
                        <select name="plan" id="plan">
                            <option value="10" @if ($plans->plan == '10') selected @endif>10 URLs</option>
                            <option value="1000" @if ($plans->plan == '1000') selected @endif>1000 URLs</option>
                            <option value="unlimited" @if ($plans->plan == 'unlimited') selected @endif>Unlimited</option>
                        </select>
                        <button type="submit" class="btn btn-warning">Upgrade Plan</button>
                        <a href="{{ url('/home') }}" class="btn btn-primary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection