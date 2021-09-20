@extends('layout.master')

@section('title', 'Add New Page')

@if(Session::has("success"))
<script>
    window.onload = function() {
        swal({
            title: "Success",
            text: "Order Is Added Successfully",
            icon: "success",
        });
    }
</script>
@endif


@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-center">Add New Order</h4>
            </div>
            <div class="panel-body">
                
                <form action="/orders" method="POST" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" class="form-control" name="order_name" value="{{ old("order_name") }}" required />
                        <span class="text-danger">
                            @error('order_name')
                                <i class="glyphicon glyphicon-exclamation-sign"></i>
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group">
                        <label>Customer Address</label>
                        <textarea name="order_address" class="form-control" required></textarea>
                        <span class="text-danger">
                            @error('order_address')
                                <i class="glyphicon glyphicon-exclamation-sign"></i>
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
    
                    <div class="form-group">
                        <label>Products</label>
                        <hr />
                        <span id="spanProductDetails"></span>
                        <hr />
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" id="payment_status" checked />
                        </div>
                        <input type="hidden" name="payment_status" id="hiddenPaymentStatus" value="1" />                        
                    </div>

                    <div class="form-group">
                        <button type="submit" id="btnManageOrders" class="btn btn-primary">New Order</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function addProductRow(count = "")
        {
            var html = "";
            html += '<span id="row'+count+'"><div class="row">';

            html += '<div class="col-md-9">';
            html += '<select name="product_id[]" id="product_id'+count+'" class="form-control selectpicker" data-live-search="true" required>';
            html += '<?php echo $products ?>';
            html += '</select><input type="hidden" name="hidden_product_id[]" id="hidden_product_id'+count+'" />';
            html += '</div>';

            html += '<div class="col-md-2">';
            html += '<input type="number" name="quantity[]" class="form-control quantityFields" autocomplete="off" step="0.5" min="0" required />';
            html += '</div>';

            html += '<div class="col-md-1">';
            if(count == '')
            {
                html += '<button type="button" name="add_more" id="add_more" class="btn btn-success btn-block"><i class="glyphicon glyphicon-plus"></i></button>';
            }
            else
            {
                html += '<button type="button" name="remove" id="'+count+'" class="btn btn-danger btn-block remove"><i class="glyphicon glyphicon-remove"></i></button>';
            }
            html += '</div>';
            html += '</div></div><br /></span>';
            $('#spanProductDetails').append(html);
            $('.selectpicker').selectpicker();
        }

        var count = 0;

        $(document).on("click", "#add_more", function() {
            count = count + 1;
            addProductRow(count);
        });

        $(document).on('click', '.remove', function(){
            var row_no = $(this).attr("id");
            $('#row'+row_no).remove();
        });
        
        addProductRow();

        $("#payment_status").bootstrapToggle({
            on: "Cash",
            off: "Credit Card",
            onstyle: "success",
            offstyle: "info"
        });


        $("#payment_status").change(function() {
            if ($(this).prop("checked")) {
                $("#hiddenPaymentStatus").val("1");
            } else {
                $("#hiddenPaymentStatus").val("0");
            }
        });


    </script>
@endsection
