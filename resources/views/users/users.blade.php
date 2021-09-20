@extends('layout.master')

@section('title', 'Users Page')


@if(Session::has("success"))
<script>
    window.onload = function() {
        swal({
            title: "Success",
            text: "User Is Deleted Successfully",
            icon: "success",
        });
    }
</script>
@endif

@section('content')

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-center">Manage Users</h4>
            </div>
            <div class="panel-body">
                <a href="users/create" class="addNewbtn btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add New User</a>
                <div class="table-responsive">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <th>Image</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>User Status</th>
                            <th>Total Sales</th>
                            <th>Today Sales</th>
                            <th>Last 7 Days Sales</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><img class="img-thumbnail tableUserImage" src="{{ asset("uploads/profile_images/" . $user->user_image ) }}" /></td>
                                    <td>{{ $user->user_name }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    @if ($user->user_status == 1)
                                        <td class="text-success">Activated</td>
                                    @else
                                        <td class="text-danger">Unactivated</td>
                                    @endif
                                    <td>{{ $user->orders->sum("order_total") }} L.E</td>
                                    <td>{{ $user->orders->whereBetween("created_at", [date("Y-m-d"), \Carbon\Carbon::now()])->sum("order_total") }} L.E</td>
                                    <td>{{ $user->orders->whereBetween("created_at", [\Carbon\Carbon::now()->subDays(7), \Carbon\Carbon::now()])->sum("order_total") }} L.E</td>
                                    <td><a href="/users/{{ $user->id }}/edit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a></td>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                        data-id="{{ $user->id }}" data-user_name="{{ $user->user_name }}" data-toggle="modal"
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
                    <h4 class="modal-title">Delete User</h4>
                </div>
                <form action="/users/destroy" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p>Are You Sure To Delete?</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="user_name" id="user_name" type="text" readonly />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
            </div>
            </form>
        </div>
    </div>


@endsection

@section('js')

<script>
    $(function() {
        $(".table").DataTable();    
    });

	$('#modaldemo9').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var user_name = button.data('user_name')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #user_name').val(user_name);
	})

</script>

@endsection