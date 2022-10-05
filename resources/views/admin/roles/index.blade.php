@extends('admin.master')

@section('content')
    <x-admin.content-header title="لیست سطوح دسترسی">
        <x-slot name="breadcrumbs">
            <li class="breadcrumb-item active">لیست سطوح دسترسی</li>
        </x-slot>
    </x-admin.content-header>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">سطوح دسترسی</h3>

                    <div class="card-tools d-flex">
                        <form>
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request()->search }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                        <a class="btn btn-info btn-sm mr-3" href="/admin/roles/create">
                            ایجاد سطح دسترسی
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>توضیح</th>
                            <th>اقدامات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->label }}</td>
                                <td>
                                    <form action="/admin/roles/{{ $role->id }}" method="post">
                                        <a class="btn btn-primary btn-sm" href="/admin/roles/{{ $role->id }}/edit">ویرایش</a>

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
                    {{ $roles->render() }}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
