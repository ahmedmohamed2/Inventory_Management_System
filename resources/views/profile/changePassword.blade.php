@extends('layout.master')

@section('title', 'Change Password Page')

@if(Session::has("success"))
<script>
    window.onload = function() {
        swal({
            title: "Success",
            text: "User Password Is Changed Successfully",
            icon: "success",
        });
    }
</script>
@endif

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel panel-heading text-center">
                <h4>Change Password</h4>
            </div>
            <div class="panel-body">
                
                <form action="/profile/changePassword" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" />
                        <span class="text-danger">
                            @error('password')
                                <i class="glyphicon glyphicon-exclamation-sign"></i>
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
    
                    <div class="form-group">
                        <label>Rewrite Password</label>
                        <input type="password" name="password_confirmation" class="form-control" />
                    </div>

                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
