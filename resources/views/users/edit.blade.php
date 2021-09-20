@extends('layout.master')

@section('title', 'Edit User Page')


@section('content')
<div class="container">

    @if(Session::has("success"))
        <script>
            window.onload = function() {
                swal({
                    title: "Success",
                    text: "User Is Updated Successfully",
                    icon: "success",
                });
            }
        </script>
    @endif

    <div class="panel panel-primary">
        <div class="panel panel-heading text-center">
            <h4>Edit User</h4>
        </div>
        <div class="panel-body">      
            <form action="/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
                {{ method_field("patch") }}
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" id="user_name" name="user_name" class="form-control" value="{{ $user->user_name }}" autocomplete="off"   />
                    <span class="text-danger">
                        @error('user_name')
                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" id="full_name" name="full_name" class="form-control" value="{{ $user->full_name }}" autocomplete="off"   />
                    <span class="text-danger">
                        @error('full_name')
                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <input type="checkbox" id="user_status" @if ($user->user_status == 1) {{ "checked" }}  @endif />
                    </div>
                    <input type="hidden" name="user_status" id="hiddenUserStatus" value="@if($user->user_status == 1){{"1"}}@else{{"0"}}@endif" />
                </div>
                <div class="form-group">
                    <label>User Image</label>
                    <input 
                        type="file" 
                        name="user_image"
                        id="user_image"
                        class="form-control"
                        accept="image/jpg,image/jpeg,image/png"
                        />
                    <span class="text-danger">
                        @error('user_image')
                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <button type="submit" name="btnAddNewUser" class="btn btn-primary">Edit User</button>
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

            $("#user_status").bootstrapToggle({
                on: "Activated",
                off: "Unactivated",
                onstyle: "success",
                offstyle: "danger"
            });

            /**
             * To Change Value In UserStatus Checkbox
            */    

            $("#user_status").change(function() {
                if ($(this).prop("checked")) {
                    $("#hiddenUserStatus").val("1");
                } else {
                    $("#hiddenUserStatus").val("0");
                }
            });


        });

    </script>
@endsection
