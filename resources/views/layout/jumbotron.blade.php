<div class="jumbotron">
    <div class="container">
        <div class="row">

            <div class="col-md-11">
                <p class="userWelcomeText">Welcome At Inventory Management System --- [ {{ session("full_name") }} ] </p>
                <a href="/" class="btn btn-primary"><i class="glyphicon glyphicon-dashboard"></i> Mainboard</a>
                <a href="/changepassword" class="btn btn-success"><i class="glyphicon glyphicon-flash"></i> Change Password</a>
                <a href="/profile" class="btn btn-warning"><i class="glyphicon glyphicon-user"></i> Profile</a>
                <a href="/auth/logout" class="btn btn-danger"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
            </div>

            <div class="col-md-1">
                <img class="img-thumbnail tableUserImage" src="{{ asset("uploads/profile_images/" . session("user_image")) }}" />
            </div>
        </div>
    </div>
</div>

