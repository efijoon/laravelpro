@extends('admin.master')

@section('content')
    <x-admin.content-header title="لیست محصولات">
        <x-slot name="breadcrumbs">
            <li class="breadcrumb-item active">لیست محصولات</li>
        </x-slot>
    </x-admin.content-header>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">محصولات</h3>

                    <div class="card-tools d-flex">
                        <form>
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request()->search }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                        <a class="btn btn-info btn-sm mr-3" href="/admin/products/create">
                            ایجاد محصول
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>آیدی</th>
                            <th>تصویر</th>
                            <th>نام</th>
                            <th>موجودی</th>
                            <th>تعداد بازدید</th>
                            <th>اقدامات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <img src="/uploads/product/{{ $product->name }}" alt="product-image">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->views_count }}</td>
                                <td>
                                    <form action="/admin/products/{{ $product->id }}" method="post">
                                        <a class="btn btn-primary btn-sm" href="/admin/products/{{ $product->id }}/edit">ویرایش</a>

                                        @csrf @method("delete")
                                        <button class="btn btn-danger btn-sm">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {{ $products->render() }}
                </div>
            </div>
        </div>
    </div>
@endsection
