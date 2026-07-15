@extends('layouts.main')

@section('title')
    Eduxamp | User
@endsection

@section('css_custom')
@endsection

@section('content')
    <div class="flex-grow-1 p-4">
        <div class="d-grid gap-3">

            <h1>Daftar Users</h1>

            <div>
                <a href="{{ route('user.create') }}" class="btn btn-secondary btn-sm">
                    Add User
                </a>
            </div>

            <table id="dg-user" class="easyui-datagrid"
                data-options="
                fitColumns:true,
                singleSelect:true,
                pagination:true,
                striped:true
            ">
                <thead>
                    <tr>
                        <th data-options="field:'name'" width="150">Name</th>
                        <th data-options="field:'email'" width="250">Email</th>
                        <th data-options="field:'role'" width="250">Role</th>
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

            loadUsers();

        });

        function loadUsers() {
            $.ajax({

                url: "{{ route('api.user.all') }}",
                type: "GET",

                success: function(response) {
                    console.log(response.data[0])
                    
                    let rows = response.data.map(function(item) {

                        return {

                            id: item.id,

                            name: item.name,

                            email: item.email ?? '-',

                            role: item.role.name ?? '-',

                            status: item.is_active ?
                                '<span class="badge bg-success">Active</span>' :
                                '<span class="badge bg-danger">Inactive</span>',

                            action: '<a href="/user/detail/' + item.id +
                                '" class="btn btn-primary btn-sm me-1">View</a>' +
                                '<a href="/user/edit/' + item.id +
                                '" class="btn btn-warning btn-sm me-1">Edit</a>' +
                                '<button class="btn btn-danger btn-sm" onclick="deleteUser(' + item.id +
                                ')">Delete</button>'

                        };

                    });

                    $('#dg-user').datagrid('loadData', rows);

                }

            });
        }

        function deleteUser(id) {
            if (!confirm('Delete this user?'))
                return;

            $.ajax({

                url: '/api/user/destroy/' + id,

                type: 'GET',

                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },

                success: function(response) {

                    alert(response.message);

                    loadUsers();

                },

                error: function(xhr) {

                    alert(xhr.responseJSON.message);

                }

            });
        }
    </script>
@endsection
