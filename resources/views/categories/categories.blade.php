@extends('layout.master')

@section('title', 'Categories Page')

@if(Session::has("success"))
<script>
    window.onload = function() {
        swal({
            title: "Success",
            text: "Category Is Deleted Successfully",
            icon: "success",
        });
    }
</script>
@endif

@section('content')

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-center">Manage Categories</h4>
            </div>
            <div class="panel-body">
                <a href="categories/create" class="addNewbtn btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Category</a>
                <div class="table-responsive">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <th>Category Name</th>
                            <th>Category Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        @if ($category->category_status == 1)
                                            <span class="text-success">{{ "Activated" }}</span>
                                        @else
                                            <span class="text-danger">{{ "Unactivated" }}</span>
                                        @endif
                                    </td>
                                    <td><a href="/categories/{{ $category->id }}/edit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a></td>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                        data-id="{{ $category->id }}" data-category_name="{{ $category->category_name }}" data-toggle="modal"
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
                    <h4 class="modal-title">Delete Category</h4>
                </div>
                <form action="/categories/destroy" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p>Are You Sure To Delete?</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="category_name" id="category_name" type="text" readonly />
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


        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var category_name = button.data('category_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #category_name').val(category_name);
        })

        });
    </script>
@endsection