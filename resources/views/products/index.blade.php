@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->desc }}</p>
                            <a href="/products/{{ $product->id }}" class="btn btn-primary">جزئیات محصول</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
