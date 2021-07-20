@extends('backend.layouts.app')
@section('title','Admin User')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                Admin Users
            </div>
        </div>
    </div>
</div>

<div class="py-2">
    <a href="{{ route('admin.admin-user.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create
        Admin User</a>
</div>

<div class="content pb-3">
    <div class="card">
        <div class="card-body">
            <table id="data" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th class="no-sort">Ip</th>
                        <th class="no-sort">User Agent</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th class="no-sort">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    var table = $('#data').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/admin-user/datatable/ssd',
        columns: [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'ip',
                name: 'ip'
            },
            {
                data: 'user_agent',
                name: 'user_agent'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'updated_at',
                name: 'updated_at'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
        order: [
            [6, 'desc']
        ],
        columnDef: [{
            targets: 'no-sort',
            sortable: false
        }]
    });
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure, you want to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/admin-user/' + id,
                    type: 'DELETE',
                })
                table.ajax.reload();
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    });
});
</script>
@endsection