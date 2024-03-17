@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Shorten URL</div>

                <div class="card-body">
                    <form id="shortenForm">
                        @csrf
                        <div class="alert alert-success" id="messageBox" role="alert" style="display: none;">
                            Created successfully
                        </div>
                        <span class="invalid-feedback" role="alert" id="errorMessageBox" style="display: none;">
                            <strong>Invalid Url </strong>
                        </span>
                        <div class="form-group">
                            <label for="original_url">Original URL</label>
                            <input type="text" class="form-control" id="original_url" name="original_url" placeholder="Enter URL" required>
                        </div>
                        <button id="shortenButton" type="button" class="btn btn-primary">Submit</button>
                        <a href="{{ url('/home') }}" class="btn btn-primary">Back</a>
                    </form>
                    <div id="shortenedUrlContainer" style="display: none;">
                        <p>Shortened URL: <span id="shortenedUrl"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('shortenButton').addEventListener('click', function(event) {
            event.preventDefault();
            var originalUrl = document.getElementById('original_url').value;

            if (!originalUrl) {
                document.getElementById('errorMessageBox').innerText = 'Please enter a valid URL.';
                document.getElementById('errorMessageBox').style.display = 'block';
                document.getElementById('messageBox').style.display = 'none';
                return; 
            }

            axios.post("{{ route('urls.shorten') }}", {
                    original_url: originalUrl
                })
                .then(function(response) {
                    document.getElementById('shortenedUrl').innerText = response.data.shortened_url;
                    document.getElementById('shortenedUrlContainer').style.display = 'block';
                    document.getElementById('messageBox').innerText = response.data.message;
                    document.getElementById('messageBox').style.display = 'block';
                    document.getElementById('errorMessageBox').style.display = 'none';
                })
                .catch(function(error) {
                    document.getElementById('errorMessageBox').innerText = 'An error occurred while shortening the URL or Invalid Url';
                    document.getElementById('errorMessageBox').style.display = 'block';
                    document.getElementById('messageBox').style.display = 'none';
                    console.error(error);
                });
        });
    });
</script>
@endsection