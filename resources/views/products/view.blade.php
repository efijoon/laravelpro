@extends('layouts.app')

@section('script')
  <script>
    function showModal(product_id) {
      $('#sendComment').find('input[name="parent_id"]').val(product_id);

      new bootstrap.Modal($('#sendComment')[0]).show();
    }
  </script>
@endsection

@section('content')
  @auth
    <div class="modal fade" id="sendComment">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ارسال نظر</h5>
            <button type="button" class="btn-close mr-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="/comments/add" method="post">
            @csrf

            <div class="modal-body">
              <input type="hidden" name="commentable_id" value="{{ $product->id }}">
              <input type="hidden" name="commentable_type" value="{{ get_class($product) }}">
              <input type="hidden" name="parent_id" value="0">

              <div class="form-group">
                <label for="message-text" class="col-form-label">پیام دیدگاه:</label>
                <textarea name="body" class="form-control" id="message-text"></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
              <button type="submit" class="btn btn-primary">ارسال نظر</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  @endauth

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        @include('layouts.errors')

        <div class="card">
          <div class="card-header">
            {{ $product->name }}
          </div>

          <div class="card-body">
            {{ $product->desc }}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="d-flex align-items-center justify-content-between mb-2 mt-5">
          <h4 class="mt-4">بخش نظرات</h4>

          @auth
            <span class="btn btn-sm btn-success" data-bs-toggle="modal"
                  data-bs-target="#sendComment">ثبت نظر جدید</span>
          @endauth
        </div>

        @foreach($product->comments()->where('approved', 0)->where('parent_id', 0)->get() as $comment)
          <div class="card {{ $loop->first ?: 'mt-5' }}">
            <div class="card-header d-flex justify-content-between">
              <div class="commenter d-flex">
                <span>{{ $comment->user->name }}</span>
                <span class="mx-2"> - </span>
                <span class="text-muted">{{ jdate($comment->created_at)->ago() }}</span>
              </div>

              @auth
                <span class="btn btn-sm btn-primary" onclick="showModal('{{ $product->id }}')">پاسخ به نظر</span>
              @endauth
            </div>

            <div class="card-body">
              {{ $comment->body }}

              @foreach($comment->childs as $childComment)
                <div class="card mt-3">
                  <div class="card-header d-flex justify-content-between">
                    <div class="commenter d-flex">
                      <span>{{ $childComment->user->name }}</span>
                      <span class="mx-2"> - </span>
                      <span class="text-muted">{{ jdate($childComment->created_at)->ago() }}</span>
                    </div>
                  </div>

                  <div class="card-body">
                    {{ $childComment->body }}
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
