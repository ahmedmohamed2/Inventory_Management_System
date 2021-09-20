@extends('layout.master')

@section('title', 'Create Brands Page')

@if(Session::has("success"))
<script>
    window.onload = function() {
        swal({
            title: "Success",
            text: "Brand Is Added Successfully",
            icon: "success",
        });
    }
</script>
@endif


@section('content')

<div class="container">
    <div class="panel panel-primary">
        <div class="panel panel-heading text-center">
            <h4>Add New Brand</h4>
        </div>
        <div class="panel-body">

            <form action="/brands" method="POST">
                @csrf

                <div class="form-group">
                    <label>Brand Name</label>
                    <input type="text" id="brand_name" name="brand_name" class="form-control" autocomplete="off" />
                    <span class="text-danger">
                        @error('brand_name')
                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                            {{ $message }}
                        @enderror
                    </span>
                </div>
    
                <div class="form-group">
                    <label>Category Name</label>
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="form-group">
                    <div class="checkbox">
                        <input type="checkbox" id="brand_status" checked />
                    </div>
                    <input type="hidden" name="brand_status" id="hiddenBrandStatus" value="1" />
                </div>
    
                <button type="submit" name="btnAddNewBrand" class="btn btn-primary">Add New Brand</button>
    

            </form>

        </div>
    </div>
</div>

@endsection

@section('js')
    <script>
    
        $(function() {

            /**
             * Run bootstrapToggle Plugin In UserStatus Field
             */

            $("#brand_status").bootstrapToggle({
                on: "Activated",
                off: "Unactivated",
                onstyle: "success",
                offstyle: "danger"
            });

            /**
             * To Change Value In UserStatus Checkbox
            */    

            $("#brand_status").change(function() {
                if ($(this).prop("checked")) {
                    $("#hiddenBrandStatus").val("1");
                } else {
                    $("#hiddenBrandStatus").val("0");
                }
            });


        });

    </script>
@endsection