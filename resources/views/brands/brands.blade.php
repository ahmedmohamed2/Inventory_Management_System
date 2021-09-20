@extends('layout.master')

@section('title', 'Brands Page')

@if(Session::has("success"))
<script>
    window.onload = function() {
        swal({
            title: "Success",
            text: "Brand Is Deleted Successfully",
            icon: "success",
        });
    }
</script>
@endif

@section('content')

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="text-center">Manage Brands</h4>
        </div>
        <div class="panel-body">
            <a href="brands/create" class="addNewbtn btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Brand</a>
            <div class="table-responsive">
                <table class="table table-borderd table-striped">
                    <thead>
                        <th>Brand Name</th>
                        <th>Category Name</th>
                        <th>Brand Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->brand_name }}</td>
                                <td>{{ $brand->category->category_name }}</td>
                                <td>
                                    @if ($brand->brand_status == 1)
                                        <span class="text-success">{{ "Activated" }}</span>
                                    @else
                                        <span class="text-danger">{{ "Unactivated" }}</span>
                                    @endif
                                </td>
                                <td><a href="/brands/{{ $brand->id }}/edit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a></td>
                                <td>
                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                    data-id="{{ $brand->id }}" data-brand_name="{{ $brand->brand_name }}" data-toggle="modal"
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
                    <h4 class="modal-title">Delete Brand</h4>
                </div>
                <form action="/brands/destroy" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p>Are You Sure To Delete?</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="brand_name" id="brand_name" type="text" readonly />
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
            var brand_name = button.data('brand_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #brand_name').val(brand_name);
        })

        });
    </script>
@endsection