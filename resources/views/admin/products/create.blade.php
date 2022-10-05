@extends('admin.master')

@section('content')
    <x-admin.content-header title="ایجاد محصول جدید">
        <x-slot name="breadcrumbs">
            <li class="breadcrumb-item active">ایجاد محصول جدید</li>
        </x-slot>
    </x-admin.content-header>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="/admin/products" class="form-horizontal" method="post">
                    @csrf

                    <div class="card-body">
                        @include('admin.layouts.errors')

                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label for="inputEmail3" class="control-label">نام</label>
                                <input name="name" class="form-control" placeholder="نام را وارد کنید" value="{{ old('name') }}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="inputEmail3" class="control-label">تصویر</label>
                                <input type="file" name="image" class="form-control" placeholder="تصویر را وارد کنید" value="{{ old('image') }}">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="inputEmail3" class="control-label">موجودی</label>
                                <input type="number" min="0" name="stock" class="form-control" placeholder="موجودی را وارد کنید" value="{{ old('stock') }}">
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="inputEmail3" class="control-label">توضیحات</label>
                                <input name="desc" class="form-control" placeholder="توضیحات را وارد کنید" value="{{ old('desc') }}">
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
