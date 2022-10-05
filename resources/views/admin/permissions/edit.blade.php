@extends('admin.master')

@section('content')
    <x-admin.content-header title="ویرایش اجازه دسترسی جدید">
        <x-slot name="breadcrumbs">
            <li class="breadcrumb-item active">ویرایش اجازه دسترسی جدید</li>
        </x-slot>
    </x-admin.content-header>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="/admin/permissions/{{ $permission->id }}" class="form-horizontal" method="post">
                    @csrf @method('PUT')

                    <div class="card-body">
                        @include('admin.layouts.errors')

                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label for="inputEmail3" class="control-label">نام</label>
                                <input name="name" class="form-control" placeholder="نام را وارد کنید" value="{{ old('name', $permission->name) }}">
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="inputEmail3" class="control-label">توضیحات</label>
                                <input name="label" class="form-control" placeholder="توضیحات را وارد کنید" value="{{ old('label', $permission->label) }}">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-left px-4">ویرایش</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
