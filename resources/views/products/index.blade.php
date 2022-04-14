@extends('layouts.products-layout')

@section('title', 'View Products')

@push('custom-css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin-lte-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin-lte-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin-lte-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- DataTables -->
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
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
                        View All Products
                    </h1>
                </div>
                @include(
                    'partials.products-partials.products-breadcrumb', 
                    [ 'breadCrumbItems' => $breadCrumbItems ]
                )
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="products-data-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>Product Price</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <img 
                                                    src="{{ asset('storage/products_images/' . $product->product_image) }}" 
                                                    alt="{{ $product->product_name }}"
                                                    width="150"
                                                    heigth="150" />
                                            </td>
                                            <td>
                                                {{ $product->product_name }}
                                            </td>
                                            <td>
                                                {{ Str::limit( $product->product_description, 30) }}
                                            </td>
                                            <td class="text-center">
                                                ${{ $product->product_price }}
                                            </td>
                                            <td class="text-center">
                                                <a 
                                                    class="btn btn-sm btn-info" 
                                                    href="{{ route('products.show', $product->id) }}"
                                                >
                                                    <i class="fas fa-eye mr-1"></i>
                                                    View
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a 
                                                    class="btn btn-sm btn-warning" 
                                                    href="{{ route('products.edit', $product->id) }}"
                                                >
                                                    <i class="fas fa-edit mr-1"></i>
                                                    Edit
                                                </a>   
                                            </td>
                                            <td class="text-center">
                                                <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                                                    @method('DELETE')    
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger delete-product-btn"
                                                        onclick="if (!confirm('Are you sure?')) { return false; }">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>Product Price</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection


@push('custom-scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin-lte-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin-lte-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin-lte-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin-lte-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin-lte-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin-lte-assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin-lte-assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin-lte-assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin-lte-assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin-lte-assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin-lte-assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin-lte-assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- DataTables  & Plugins -->

<script>
    $(function() {
        $("#products-data-table").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
        })
        .buttons()
        .container()
        .appendTo('#products-data-table_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush