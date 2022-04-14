@extends('layouts.products-layout')

@section('title', 'View Product')

@section('content')
    <div class="content-wrapper" style="word-wrap: break-word;">
        <div class="content-header">
            <div class="container-fluid" style="margin-top: 20vh;">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-end">
                        <img src="{{ asset('storage/products_images/' . $product->product_image) }}"
                            height="250" width="250"
                            alt="{{ $product->product_name }}">
                    </div>
                    <div class="col-md-6">
                        <h1>
                            <strong>Name:</strong> {{ $product->product_name }}
                        </h1>
                        <h3>
                            <strong>Price:</strong> ${{ $product->product_price }}
                        </h3>
                        <p class="text-justify">
                           <strong>Description</strong> {{ $product->product_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection