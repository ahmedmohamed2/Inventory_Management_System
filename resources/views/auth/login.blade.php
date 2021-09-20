@extends('layout.master')

@section('title', 'Login Page')


@section('content')

    @if(Session::has("error"))
        <script>
            window.onload = function() {
                swal({
                    title: "Error",
                    text: "Username Or Password Is Inncorrect",
                    icon: "error",
                });
            }
        </script>
    @endif

    @if(Session::has("check_user"))
        <script>
            window.onload = function() {
                swal({
                    title: "Error",
                    text: "You Must Logged In First",
                    icon: "error",
                });
            }
        </script>
    @endif

    <div class="loginPage">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="loginForm">
                    <form action="/auth/check" method="post">
                        @csrf
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="text-center">Login To Inventory System</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="user_name" id="user_name" class="form-control" autocomplete="off" value="{{ old("user_name") }}"  />
                                    <span class="text-danger">
                                        @error('user_name')
                                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="user_password" id="user_password" class="form-control"  />
                                    <span class="text-danger">
                                        @error('user_password')
                                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="login" id="login" class="btn btn-primary btn-block">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
@endsection

