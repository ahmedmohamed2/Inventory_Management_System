@extends('layout.master')

@section('title', 'Products Page')

@if(Session::has("success"))
<script>
    window.onload = function() {
        swal({
            title: "Success",
            text: "Product Is Deleted Successfully",
            icon: "success",
        });
    }
</script>
@endif

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-center">Manage Products</h4>
            </div>
            <div class="panel-body">
                <a href="products/create" class="addNewbtn btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Product</a>
                <div class="table-responsive">
                    <table class="table table-borderd table-striped dataTable">
                        <thead>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Tax</th>
                            <th>Info</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->category->category_name }}</td>
                                    <td>{{ $product->brand->brand_name }}</td>
                                    <td>{{ $product->product_quantity }}</td>
                                    <td>{{ $product->product_price }} L.E </td>
                                    <td>{{ $product->product_tax }} %</td>
                                    <td>
                                        <button 
                                            class="btn btn-info" 
                                            data-toggle="modal" 
                                            data-target="#modaldemo10"
                                            data-name="{{ $product->product_name }}"
                                            data-description="{{ $product->product_description }}"
                                            data-quantity="{{ $product->product_quantity }}"
                                            data-price="{{ $product->product_price }} L.E"
                                            data-tax="{{ $product->product_tax }} %"
                                            data-status="@if ($product->product_status == 1) {{ "Activated" }} @else {{ "Unactivated" }} @endif "
                                            data-unit="{{ $product->unit->unit_name}}"
                                            data-category="{{ $product->category->category_name }}"
                                            data-brand="{{ $product->brand->brand_name }}"
                                            data-user="{{ $product->user->full_name }}">
                                            <i class="glyphicon glyphicon-info-sign"></i> Info
                                        </button>
                                    </td>
                                    <td><a href="/products/{{ $product->id }}/edit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a></td>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                        data-id="{{ $product->id }}" data-product_name="{{ $product->product_name }}" data-toggle="modal"
                                        href="#modaldemo9" title="Delete"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                                    </td>                               
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- delete -->
    <div class="modal fade" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Product</h4>
                </div>
                <form action="/products/destroy" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p>Are You Sure To Delete?</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="product_name" id="product_name" type="text" readonly />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
            </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="modaldemo10">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Product Information</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-borderd text-center">
                        <tbody>
                            <tr>
                                <td width="30%">Product Name</td>
                                <td width="70%" id="product_name"></td>
                            </tr>
                            <tr>
                                <td width="30%">Product Category</td>
                                <td width="70%" id="category_id"></td>
                            </tr>
                            <tr>
                                <td width="30%">Product Brand</td>
                                <td width="70%" id="brand_id"></td>
                            </tr>
                            <tr>
                                <td width="30%">Product Description</td>
                                <td width="70%" id="product_description"></td>
                            </tr>
                            <tr>
                                <td width="30%">Product Quantity</td>
                                <td width="70%" id="product_quantity"></td>
                            </tr>
                            <tr>
                                <td width="30%">Product Tax</td>
                                <td width="70%" id="product_tax"></td>
                            </tr>
                            <tr>
                                <td width="30%">Product Price</td>
                                <td width="70%" id="product_price"></td>
                            </tr>
                            <tr>
                                <td width="30%">Product Unit</td>
                                <td width="70%" id="unit_id"></td>
                            </tr>
                            <tr>
                                <td width="30%">Added User</td>
                                <td width="70%" id="user_id"></td>
                            </tr>
                            <tr>
                                <td width="30%">Product Status</td>
                                <td width="70%" id="product_status"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('js')
<script>
    $(function() {
        $(".dataTable").DataTable();


        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('product_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
        })

        $('#modaldemo10').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)

            var product_name        = button.data('name')
            var product_description = button.data('description')
            var product_quantity    = button.data('quantity')
            var product_price       = button.data('price')
            var product_tax         = button.data('tax')
            var product_status      = button.data('status')
            var product_unit        = button.data('unit')
            var product_category    = button.data('category')
            var product_brand       = button.data('brand')
            var product_user        = button.data('user')

            var modal = $(this)            
            modal.find('.modal-body #product_name').html(product_name);
            modal.find('.modal-body #product_description').html(product_description);
            modal.find('.modal-body #product_quantity').html(product_quantity);
            modal.find('.modal-body #product_price').html(product_price);
            modal.find('.modal-body #product_tax').html(product_tax);
            modal.find('.modal-body #product_status').html(product_status);
            modal.find('.modal-body #unit_id').html(product_unit);
            modal.find('.modal-body #category_id').html(product_category);
            modal.find('.modal-body #brand_id').html(product_brand);
            modal.find('.modal-body #user_id').html(product_user);
        })

    });
</script>
@endsection