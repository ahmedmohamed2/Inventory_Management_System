@extends('layout.master')

@section('title', 'Add Product Page')

@if(Session::has("success"))
<script>
    window.onload = function() {
        swal({
            title: "Success",
            text: "Product Is Added Successfully",
            icon: "success",
        });
    }
</script>
@endif

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-center">Add New Product</h4>
            </div>
            <div class="panel-body">

                
            <form action="/products" method="POST" autocomplete="off">
                @csrf
                
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" id="product_name" name="product_name" class="form-control" value="{{ old("product_name") }}" autocomplete="off" />
                    <span class="text-danger">
                        @error('product_name')
                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="" selected disabled>---</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('category_id')
                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label>Brand</label>
                    <select id="brand_id" name="brand_id" class="form-control">
                        <option value="" selected disabled>---</option>
                    </select>
                    <span class="text-danger">
                        @error('brand_id')
                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="product_description" id="product_description" class="form-control" rows="5"></textarea>
                    <span class="text-danger">
                        @error('product_description')
                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="product_quantity" id="product_quantity" class="form-control" step="0.5" min="0" />
                            <span class="text-danger">
                                @error('product_quantity')
                                    <i class="glyphicon glyphicon-exclamation-sign"></i>
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="product_price" id="product_price" class="form-control" step="0.5" min="0" />
                            <span class="text-danger">
                                @error('product_price')
                                    <i class="glyphicon glyphicon-exclamation-sign"></i>
                                    {{ $message }}
                                @enderror
                            </span>                            
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tax</label>
                            <input type="number" name="product_tax" id="product_tax" class="form-control" step="0.5" min="0" />
                            <span class="text-danger">
                                @error('product_tax')
                                    <i class="glyphicon glyphicon-exclamation-sign"></i>
                                    {{ $message }}
                                @enderror
                            </span>   
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Product Unit</label>
                            <select name="unit_id" id="unit_id" class="form-control">
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <button type="button" class="btn btn-info btn-sm btnAddUnit" data-toggle="modal" data-target=".addUnitModal">
                            <i class="glyphicon glyphicon-plus"></i>
                        </button>
                    </div>

                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <input type="checkbox" id="product_status" checked />
                    </div>
                    <input type="hidden" name="product_status" id="hiddenProductStatus" value="1" />
                </div>
                
                <button type="submit" name="btnAddNewProduct" class="btn btn-primary">Add New Product</button>
    

            </form>

            </div>
        </div>
    </div>

    <div class="modal fade addUnitModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Add New Unit</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Unit Name</label>
                        <input type="text" id="unit_name" name="unit_name" class="form-control" autocomplete="off" />
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-info" id="addUnit">Add New Unit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

<script>


    function allData()
    {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ URL::to('units') }}/all",
            success:function(data) {
                $("#unit_id").empty();
                $.each(data, function(key, value) {
                    $('#unit_id').append('<option value="' + key + '">' + value + '</option>');                    
                });
            }

        });
    }
    
    $(function() {

        /**
         * Run bootstrapToggle Plugin In UserStatus Field
         */

        $("#product_status").bootstrapToggle({
            on: "Activated",
            off: "Unactivated",
            onstyle: "success",
            offstyle: "danger"
        });

        /**
         * To Change Value In UserStatus Checkbox
        */    

        $("#product_status").change(function() {
            if ($(this).prop("checked")) {
                $("#hiddenProductStatus").val("1");
            } else {
                $("#hiddenProductStatus").val("0");
            }
        });


        $("#category_id").on("change", function() {
            
            var brand_id = $(this).val();

            $.ajax({
                url: "{{ URL::to('get_brands') }}/" + brand_id,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $("#brand_id").empty();
                    $.each(data, function(key, value) {
                        $('#brand_id').append('<option value="' + key + '">' + value + '</option>');                    
                    });
                }
            });

        });


        $("#addUnit").on("click", function() {

            var unit_name = $("#unit_name").val();

            if (unit_name != "") {

                $.ajax({
                    url: "{{ URL::to('units') }}/store",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        unit_name: unit_name
                    },
                    success:function(data) {
                        $("#unit_name").val("");
                        allData();
                        swal({
                            title: "Success",
                            text: "Unit Is Added Successfully",
                            icon: "success",
                        });
                    },
                    error:function(error) {
                        console.log(error);
                    }
                });

            } else {
                swal({
                    title: "Warning",
                    text: "Please Write Unit Name",
                    icon: "warning",
                });
            }



        });


    });

</script>

@endsection
