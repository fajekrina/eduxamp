@extends('layouts.main')

@section('title')
    Eduxamp | Major
@endsection

@section('css_custom')
@endsection

@section('content')
    <div class="flex-grow-1 p-4">
        <div class="d-grid gap-3">

            <h1>Daftar Majors</h1>

            <div>
                <a href="{{ route('major.create') }}" class="btn btn-secondary btn-sm">
                    Add Major
                </a>
            </div>

            <table id="dg-major" class="easyui-datagrid"
                data-options="
                fitColumns:true,
                singleSelect:true,
                pagination:true,
                striped:true
            ">
                <thead>
                    <tr>
                      <th data-options="field:'major_code'" width="100">Code</th>
                      <th data-options="field:'major_name'" width="150">Name</th>
                      <th data-options="field:'faculty'" width="150">Faculty</th>
                      <th data-options="field:'description'" width="150">Description</th>
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

            loadMajors();

        });

        function loadMajors() {
            $.ajax({

                url: "{{ route('api.major.all') }}",
                type: "GET",

                success: function(response) {
                    console.log(response.data)
                    let rows = response.data.map(function(item) {

                        return {

                            id: item.id,

                            major_code: item.major_code,
                            major_name: item.major_name,
                            faculty: item.faculty,

                            description: item.description ?? '-',

                            status: item.is_active ?
                                '<span class="badge bg-success">Active</span>' :
                                '<span class="badge bg-danger">Inactive</span>',

                            action: '<a href="/major/detail/' + item.id +
                                '" class="btn btn-primary btn-sm me-1">View</a>' +
                                '<a href="/major/edit/' + item.id +
                                '" class="btn btn-warning btn-sm me-1">Edit</a>' +
                                '<button class="btn btn-danger btn-sm" onclick="deleteMajor(' + item.id +
                                ')">Delete</button>'

                        };

                    });

                    $('#dg-major').datagrid('loadData', rows);

                }

            });
        }

        function deleteMajor(id) {
            if (!confirm('Delete this major?'))
                return;

            $.ajax({

                url: '/api/major/destroy/' + id,

                type: 'GET',

                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },

                success: function(response) {

                    alert(response.message);

                    loadMajors();

                },

                error: function(xhr) {

                    alert(xhr.responseJSON.message);

                }

            });
        }
    </script>
@endsection
