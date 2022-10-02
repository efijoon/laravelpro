@extends('profile.master')

@section('profile-card-body')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <span>{{ $error }}</span>
            </div>
        @endforeach
    @endif

    <form action="{{ route("changeTwoFactorSettings") }}" method="post">
        @csrf

        <label>Type:</label>
        <select name="type" class="form-control mb-4">
            <option value="disable" {{ old("type") ?? auth()->user()->two_factor_type == "disable" ? "selected" : "" }}>Off</option>
            <option value="sms" {{ old("type") ?? auth()->user()->two_factor_type == "sms" ? "selected" : "" }}>SMS</option>
        </select>

        <label>Phone Number:</label>
        <input class="form-control mb-4" name="phone_number" value="{{ old("phone_number") ?? auth()->user()->phone_number }}">

        <button class="btn btn-primary px-4">Submit</button>
    </form>
@endsection
