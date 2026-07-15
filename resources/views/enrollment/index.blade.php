@extends('layouts.main')

@section('title')
    Eduxamp | Enrollment
@endsection

@section('css_custom')
@endsection

@section('content')
    <div class="flex-grow-1 p-4">
        <div class="d-grid gap-3">

            <h1>Daftar Enrollments</h1>

            <div>
                <a href="{{ route('enrollment.create') }}" class="btn btn-secondary btn-sm">
                    Add Enrollment
                </a>
            </div>

            <table id="dg-enrollment" class="easyui-datagrid"
                data-options="
                fitColumns:true,
                singleSelect:true,
                pagination:true,
                striped:true
            ">
                <thead>
                    <tr>
                      <th data-options="field:'enrollment_date'" width="250">Date</th>
                        <th data-options="field:'name'" width="150">Name</th>
                        <th data-options="field:'major'" width="250">Major</th>
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

            loadEnrollments();

        });

        function loadEnrollments() {
            $.ajax({

                url: "{{ route('api.enrollment.all') }}",
                type: "GET",

                success: function(response) {
                    console.log(response.data[0])
                    
                    let rows = response.data.map(function(item) {

                        return {

                            id: item.id,

                            enrollment_date: item.enrollment_date,

                            name: item.student_name_snapshot,

                            major: item.major_name_snapshot,
                            status: item.status,  

                            action: '<a href="/enrollment/detail/' + item.id +
                                '" class="btn btn-primary btn-sm me-1">View</a>' +
                                '<a href="/enrollment/edit/' + item.id +
                                '" class="btn btn-warning btn-sm me-1">Edit</a>' +
                                '<button class="btn btn-danger btn-sm" onclick="deleteEnrollment(' + item.id +
                                ')">Delete</button>'

                        };

                    });

                    $('#dg-enrollment').datagrid('loadData', rows);

                }

            });
        }

        function deleteEnrollment(id) {
            if (!confirm('Delete this enrollment?'))
                return;

            $.ajax({

                url: '/api/enrollment/destroy/' + id,

                type: 'GET',

                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },

                success: function(response) {

                    alert(response.message);

                    loadEnrollments();

                },

                error: function(xhr) {

                    alert(xhr.responseJSON.message);

                }

            });
        }
    </script>
@endsection
