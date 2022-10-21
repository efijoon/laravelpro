@extends('admin.master')

@section('content')
  <x-admin.content-header title="لیست نظرات">
    <x-slot name="breadcrumbs">
      <li class="breadcrumb-item active">لیست نظرات</li>
    </x-slot>
  </x-admin.content-header>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">نظرات</h3>

          <div class="card-tools d-flex">
            <form>
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="search" class="form-control float-right" placeholder="جستجو"
                       value="{{ request()->search }}">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>آیدی</th>
              <th>کاربر ارسال کننده</th>
              <th>متن</th>
              <th>برای محصول</th>
              <th>وضعیت</th>
              <th>اقدامات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
              <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->user->name }}</td>
                <td>{{ $comment->body }}</td>
                <td>{{ $comment->commentable->name }}</td>
                <td>
                  <span class="btn btn-sm btn-outline-{{ $comment->approved ? 'success' : 'danger' }}">
                    {{ $comment->approved ? 'تایید شده' : 'تاییده نشده' }}
                  </span>
                </td>
                <td class="d-flex">
                  <form class="ml-2" method="post" action="/admin/comments/{{ $comment->id }}">
                    @csrf @method("put")

                    <input name="approved" value="{{ $comment->approved ? '' : 'yes' }}" hidden>

                    <button class="btn btn-{{ $comment->approved ? 'dark' : 'success' }} btn-sm">
                      {{ $comment->approved ? 'رد' : 'تایید' }}
                    </button>
                  </form>

                  <form action="/admin/products/{{ $comment->id }}" method="post">
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
          {{ $comments->render() }}
        </div>
      </div>
    </div>
  </div>
@endsection
