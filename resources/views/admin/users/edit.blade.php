@extends('admin.master')

@section('content')
    <x-admin.content-header title="ویرایش کاربر">
        <x-slot name="breadcrumbs">
            <li class="breadcrumb-item active">ویرایش کاربر</li>
        </x-slot>
    </x-admin.content-header>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="/admin/users/{{ $user->id }}" class="form-horizontal" method="post">
                    @csrf @method('PUT')

                    <div class="card-body">
                        @include('admin.layouts.errors')

                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label for="inputEmail3" class="control-label">ایمیل</label>
                                <input name="email" type="email" class="form-control" placeholder="ایمیل را وارد کنید" value="{{ old('email', $user->email) }}">
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="inputEmail3" class="control-label">نام</label>
                                <input name="name" class="form-control" placeholder="نام را وارد کنید" value="{{ old('name', $user->name) }}">
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="inputPassword3" class="control-label">پسورد</label>
                                <input name="password" type="password" class="form-control" placeholder="پسورد را وارد کنید" value="{{ old('password') }}">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-left px-4">ورود</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
