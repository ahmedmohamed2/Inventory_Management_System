@extends('layout.master')

@section('title', 'Edit Category Page')

@section('content')

@if(Session::has("success"))
<script>
    window.onload = function() {
        swal({
            title: "Success",
            text: "Category Updated Successfully",
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
                <form action="/categories/{{ $category->id }}" method="POST">
                    {{ method_field("patch") }}
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" id="category_name" name="category_name" class="form-control" value="{{ $category->category_name }}" autocomplete="off" />
                        <span class="text-danger">
                            @error('category_name')
                                <i class="glyphicon glyphicon-exclamation-sign"></i>
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    
                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" id="category_status" @if ($category->category_status == 1) {{ "checked" }}  @endif />
                        </div>
                        <input type="hidden" name="category_status" id="hiddenCategoryStatus" value="@if($category->category_status == 1){{"1"}}@else{{"0"}}@endif" />
                    </div>

                    <button type="submit" name="btnAddNewUser" class="btn btn-primary">Edit Category</button>
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

