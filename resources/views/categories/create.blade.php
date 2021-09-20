@extends('layout.master')

@section('title', 'Add Category Page')

@section('content')

@if(Session::has("success"))
<script>
    window.onload = function() {
        swal({
            title: "Success",
            text: "Category Added Successfully",
            icon: "success",
        });
    }
</script>
@endif


    <div class="container">
        <div class="panel panel-primary">
            <div class="panel panel-heading text-center">
                <h4>Add New Category</h4>
            </div>
            <div class="panel-body">
                <form action="/categories" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" id="category_name" name="category_name" class="form-control" autocomplete="off" />
                        <span class="text-danger">
                            @error('category_name')
                                <i class="glyphicon glyphicon-exclamation-sign"></i>
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    
                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" id="category_status" checked />
                        </div>
                        <input type="hidden" name="category_status" id="hiddenCategoryStatus" value="1" />
                    </div>

                    <button type="submit" name="btnAddNewUser" class="btn btn-primary">Add New Category</button>
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

            $("#category_status").bootstrapToggle({
                on: "Activated",
                off: "Unactivated",
                onstyle: "success",
                offstyle: "danger"
            });

            /**
             * To Change Value In UserStatus Checkbox
            */    

            $("#category_status").change(function() {
                if ($(this).prop("checked")) {
                    $("#hiddenCategoryStatus").val("1");
                } else {
                    $("#hiddenCategoryStatus").val("0");
                }
            });


        });

    </script>
@endsection

