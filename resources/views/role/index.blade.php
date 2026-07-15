@extends('layouts.main')

@section('title')
    Eduxamp | Role
@endsection

@section('css_custom')
@endsection

@section('content')
    <div class="flex-grow-1 p-4">
        <div class="d-grid gap-3">

            <h1>Daftar Roles</h1>

            <div>
                <a href="{{ route('role.create') }}" class="btn btn-secondary btn-sm">
                    Add Role
                </a>
            </div>

            <table id="dg-role" class="easyui-datagrid"
                data-options="
                fitColumns:true,
                singleSelect:true,
                pagination:true,
                striped:true
            ">
                <thead>
                    <tr>
                        <th data-options="field:'name'" width="150">Name</th>
                        <th data-options="field:'description'" width="250">Description</th>
                        <th data-options="field:'status'" width="100" align="center">Status</th>
                        <th data-options="field:'action'" width="150" align="center">Action</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
@endsection

@section('js_custom')
    <script>
        $(function() {

            loadRoles();

        });

        function loadRoles() {
            $.ajax({

                url: "{{ route('api.role.all') }}",
                type: "GET",

                success: function(response) {
                    console.log(response.data)
                    let rows = response.data.map(function(item) {

                        return {

                            id: item.id,

                            name: item.name,

                            description: item.description ?? '-',

                            status: item.is_active ?
                                '<span class="badge bg-success">Active</span>' :
                                '<span class="badge bg-danger">Inactive</span>',

                            action: '<a href="/role/detail/' + item.id +
                                '" class="btn btn-primary btn-sm me-1">View</a>' +
                                '<a href="/role/edit/' + item.id +
                                '" class="btn btn-warning btn-sm me-1">Edit</a>' +
                                '<button class="btn btn-danger btn-sm" onclick="deleteRole(' + item.id +
                                ')">Delete</button>'

                        };

                    });

                    $('#dg-role').datagrid('loadData', rows);

                }

            });
        }

        function deleteRole(id) {
            if (!confirm('Delete this role?'))
                return;

            $.ajax({

                url: '/api/role/destroy/' + id,

                type: 'GET',

                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },

                success: function(response) {

                    alert(response.message);

                    loadRoles();

                },

                error: function(xhr) {

                    alert(xhr.responseJSON.message);

                }

            });
        }
    </script>
@endsection
