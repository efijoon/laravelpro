@extends('admin.master')

@section('content')
  <x-admin.content-header title="لیست دسته بندی ها">
    <x-slot name="breadcrumbs">
      <li class="breadcrumb-item active">لیست دسته بندی ها</li>
    </x-slot>
  </x-admin.content-header>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">دسته بندی ها</h3>

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

            @can('create-permission')
              <a class="btn btn-info btn-sm mr-3" href="/admin/categories/create">
                ایجاد دسته بندی
              </a>
            @endcan
          </div>
        </div>

        <div class="card-body p-0">
          @include('admin.layouts.categories-group' , ['categories' => $categories])
        </div>

        <div class="card-footer">
          {{ $categories->render() }}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
