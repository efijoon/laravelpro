@extends('admin.master')

@section('style')
  <link rel="stylesheet" href="/admin-assets/plugins/select2/select2.css">
@endsection

@section('content')
  <x-admin.content-header title="ایجاد دسته بندی جدید">
    <x-slot name="breadcrumbs">
      <li class="breadcrumb-item active">ایجاد دسته بندی جدید</li>
    </x-slot>
  </x-admin.content-header>


  <div class="row">
    <div class="col-12">
      <div class="card">
        <form action="/admin/categories" class="form-horizontal" method="post">
          @csrf

          <div class="card-body">
            @include('admin.layouts.errors')

            <div class="row">
              <div class="form-group col-sm-3">
                <label for="inputEmail3" class="control-label">نام</label>
                <input name="name" class="form-control" placeholder="نام را وارد کنید" value="{{ old('name') }}">
              </div>

              <div class="form-group col-sm-3">
                <label for="parent" class="control-label">دسته بندی پدر</label>
                <select name="parent" class="form-control">
                  <option value="">ندارد</option>
                  @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" {{ request()->parent == $category->id ? 'selected' : '' }}>
                      {{ $category->name }}
                    </option>
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
