@extends('admin.master')

@section('content')
    <x-admin.content-header title="لیست اجازه های دسترسی">
        <x-slot name="breadcrumbs">
            <li class="breadcrumb-item active">لیست اجازه های دسترسی</li>
        </x-slot>
    </x-admin.content-header>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اجازه های دسترسی</h3>

                    <div class="card-tools d-flex">
                        <form>
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request()->search }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                        @can('create-permission')
                            <a class="btn btn-info btn-sm mr-3" href="/admin/permissions/create">
                                ایجاد اجازه دسترسی
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>توضیح</th>

                            @canany(['edit-permission', 'delete-permission'])
                                <th>اقدامات</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->label }}</td>
                                    <td>
                                        <form action="/admin/permissions/{{ $permission->id }}" method="post">
                                            @can('edit-permission')
                                                <a class="btn btn-primary btn-sm" href="/admin/permissions/{{ $permission->id }}/edit">ویرایش</a>
                                            @endcan

                                            @csrf @method("delete")

                                            @can('delete-permission')
                                                <button class="btn btn-danger btn-sm">حذف</button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {{ $permissions->render() }}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
