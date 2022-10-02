@extends('admin.master')

@section('content')
    <x-admin.content-header title="لیست کاربران">
        <x-slot name="breadcrumbs">
            <li class="breadcrumb-item active">لیست کاربران</li>
        </x-slot>
    </x-admin.content-header>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">کاربران</h3>

                    <div class="card-tools d-flex">
                        <form>
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request()->search }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                        <a class="btn btn-info btn-sm mr-3" href="/admin/users/create">
                            ایجاد کاربر
                        </a>

                        <a class="btn btn-warning btn-sm mr-3" href="{{ request()->fullUrlWithQuery(['onlyAdmins' => 'true']) }}">
                            کاربران مدیر
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>آیدی</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>کاربر ادمین</th>
                            <th>کارمند</th>
                            <th>اقدامات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->is_superuser)
                                        <span class="badge badge-success">بله</span>
                                    @else
                                        <span class="badge badge-danger">خیر</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_staff)
                                        <span class="badge badge-success">بله</span>
                                    @else
                                        <span class="badge badge-danger">خیر</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="/admin/users/{{ $user->id }}" method="post">
                                        @can('update', $user)
                                            <a class="btn btn-primary btn-sm" href="/admin/users/{{ $user->id }}/edit">ویرایش</a>
                                        @endcan

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
                    {{ $users->render() }}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
