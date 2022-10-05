@extends('admin.master')

@section('style')
    <link rel="stylesheet" href="/admin-assets/plugins/select2/select2.css">
@endsection

@section('content')
    <x-admin.content-header title="ایجاد سطح دسترسی جدید">
        <x-slot name="breadcrumbs">
            <li class="breadcrumb-item active">ایجاد سطح دسترسی جدید</li>
        </x-slot>
    </x-admin.content-header>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="/admin/roles" class="form-horizontal" method="post">
                    @csrf

                    <div class="card-body">
                        @include('admin.layouts.errors')

                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label for="inputEmail3" class="control-label">نام</label>
                                <input name="name" class="form-control" placeholder="نام را وارد کنید" value="{{ old('name') }}">
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="inputEmail3" class="control-label">توضیحات</label>
                                <input name="label" class="form-control" placeholder="توضیحات را وارد کنید" value="{{ old('label') }}">
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="inputEmail3" class="control-label">اجازه های دسترسی</label>
                                <select name="permissions[]" class="form-control select2" multiple>
                                    @foreach(\App\Models\Permission::all() as $permission)
                                        <option value="{{ $permission->id }}">{{ $permission->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-left px-4">ایجاد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/admin-assets/plugins/select2/select2.min.js"></script>
    <script>
        $('.select2').select2({
            dir: 'rtl'
        });
    </script>
@endsection
