@extends('admin.master')

@section('style')
  <link rel="stylesheet" href="/admin-assets/plugins/select2/select2.css">
@endsection

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
                <input type="file" name="image" class="form-control" placeholder="تصویر را وارد کنید"
                       value="{{ old('image') }}">
              </div>
              <div class="form-group col-sm-1">
                <label for="inputEmail3" class="control-label">موجودی</label>
                <input type="number" min="0" name="stock" class="form-control" placeholder="موجودی را وارد کنید"
                       value="{{ old('stock') }}">
              </div>
              <div class="form-group col-sm-1">
                <label for="inputEmail3" class="control-label">قیمت</label>
                <input type="number" min="0" name="price" class="form-control" placeholder="قیمت را وارد کنید"
                       value="{{ old('price') }}">
              </div>
              <div class="form-group col-sm-3">
                <label for="inputEmail3" class="control-label">دسته بندی ها</label>
                <select name="categories[]" class="form-control select2" multiple>
                  @foreach(\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-sm-12">
                <label for="inputEmail3" class="control-label">توضیحات</label>
                <input name="desc" class="form-control" placeholder="توضیحات را وارد کنید" value="{{ old('desc') }}">
              </div>

              <div class="col-12">
                <h6>ویژگی محصول</h6>
                <hr>
                <div id="attribute_section">

                </div>
                <button class="btn btn-sm btn-danger" type="button" id="add_product_attribute">ویژگی جدید</button>
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

  <div id="attribute-names" data-attributes="{{ json_encode(\App\Models\Attribute::all()->pluck('name')) }}"></div>
@endsection

@section('script')
  <script src="/admin-assets/plugins/select2/select2.min.js"></script>
  <script>
    $('.select2').select2({
      dir: 'rtl'
    });
  </script>
  <script>
    let changeAttributeValues = (event, id) => {
      let valueBox = $(`select[name='attributes[${id}][value]']`);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        }
      })

      $.ajax({
        type: 'POST',
        url: '/admin/attributes/getValues',
        data: JSON.stringify({
          name: event.target.value
        }),
        success: function (data) {
          valueBox.html(`<option selected>انتخاب کنید</option>
            ${data.data.map(function (item) {
              return `<option value="${item}">${item}</option>`
            })
          }`);

          $('.attribute-select').select2({tags: true});
        }
      });
    }

    $('#add_product_attribute').click(function () {
      let attributesSection = $('#attribute_section');
      let id = attributesSection.children().length;

      attributesSection.append(
        createNewAttr({
          attributes: $('#attribute-names').data('attributes'),
          id
        })
      );

      $('.attribute-select').select2({tags: true,dir: 'rtl'});
    });

    let createNewAttr = ({attributes, id}) => {
      return `<div class="row" id="attribute-${id}">
        <div class="col-5">
            <div class="form-group">
                 <label>عنوان ویژگی</label>
                 <select name="attributes[${id}][name]" onchange="changeAttributeValues(event, ${id});" class="attribute-select form-control">
                    <option value="">انتخاب کنید</option>
                    ${attributes.map(function (item) {
        return `<option value="${item}">${item}</option>`
      })}
                 </select>
            </div>
        </div>
        <div class="col-5">
            <div class="form-group">
                 <label>مقدار ویژگی</label>
                 <select name="attributes[${id}][value]" class="attribute-select form-control">
                    <option value="">انتخاب کنید</option>
                 </select>
            </div>
        </div>
         <div class="col-2">
            <label >اقدامات</label>
            <div>
                <button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('attribute-${id}').remove()">حذف</button>
            </div>
        </div>
      </div>`
    }
  </script>
@endsection
