@extends('profile.master')

@section('profile-card-body')
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            User Name:
            <span>{{ auth()->user()->name }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Email:
            <span>{{ auth()->user()->email }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Creation Time:
            <span>{{ auth()->user()->created_at->format("Y/m/d - H:i") }}</span>
        </li>
    </ul>
@endsection
