@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Two Factor Authenticate
                    </div>

                    <div class="card-body">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    <span>{{ $error }}</span>
                                </div>
                            @endforeach
                        @endif

                        <form action="/auth/2fa" method="post">
                            @csrf

                            <div class="form- mb-4">
                                <label>Verify Code:</label>
                                <input class="form-control {{ $errors->has("code") ? "is-invalid" : "" }}" name="code">
                                @error("code")
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <button class="btn btn-primary px-4">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
