@extends('layouts.products-layout')

@section('title', 'Add New Product')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @include('partials.session-messages')
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Create New Product
                    </h1>
                </div>
                @include(
                    'partials.products-partials.products-breadcrumb',
                    [ 'breadCrumbItems' => $breadCrumbItems ]
                )
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product-name">
                                        Product Name
                                    </label>
                                    <input type="text" class="form-control" id="product-name"
                                         name="product-name" placeholder="Enter name of the product" 
                                         value="{{ old('product-name') }}" required>
                                    @if ($errors->has('product-name'))
                                        <small class="text-danger">
                                            {{ $errors->first('product-name') }}
                                        </small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="product-description">
                                        Product Description
                                    </label>
                                    <textarea class="form-control" name="product-description" 
                                        id="product-description" cols="30" rows="10"
                                        required>{{ old('product-description') }}</textarea>
                                    @if ($errors->has('product-description'))
                                        <small class="text-danger">
                                            {{ $errors->first('product-description') }}
                                        </small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="product-price">
                                        Product Price
                                    </label>
                                    <input type="number" class="form-control" id="product-price" 
                                        name="product-price" placeholder="Enter name of the product" 
                                        value="{{ old('product-price') }}" required>
                                    @if ($errors->has('product-price'))
                                        <small class="text-danger">
                                            {{ $errors->first('product-price') }}
                                        </small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">
                                        Product Image
                                    </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="product-image" 
                                                name="product-image" value="{{ old('product-image') }}" required>
                                            <label class="custom-file-label" for="product-image">
                                                Choose Image
                                            </label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    <div>
                                        @if ($errors->has('product-image'))
                                            <small class="text-danger">
                                                {{ $errors->first('product-image') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
@endsection