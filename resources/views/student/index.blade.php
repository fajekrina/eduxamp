@extends('layouts.main')

@section('title')
    Eduxamp | Student
@endsection

@section('css_custom')
@endsection

@section('content')
    <div class="flex-grow-1 p-4">
        <div class="d-grid gap-3">

            <h1>Daftar Students</h1>

            <div>
                <a href="{{ route('student.create') }}" class="btn btn-secondary btn-sm">
                    Add Student
                </a>
                <button class="btn btn-success btn-sm" onclick="showExportModal()">
                    Export Excel
                </button>
                <button class="btn btn-info btn-sm" onclick="showImportModal()">
                    Import Excel
                </button>
            </div>

            <table id="dg-student" class="easyui-datagrid"
                data-options="
                fitColumns:true,
                singleSelect:true,
                pagination:true,
                striped:true
            ">
                <thead>
                    <tr>
                        <th data-options="field:'student_number'" width="150">NIM</th>
                        <th data-options="field:'full_name'" width="200">Name</th>
                        <th data-options="field:'gender'" width="100">Gender</th>
                        <th data-options="field:'address'" width="200">Address</th>
                        <th data-options="field:'email'" width="250">Email</th>
                        <th data-options="field:'status'" width="100" align="center">Status</th>
                        <th data-options="field:'action'" width="150" align="center">Action</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>

    <div class="modal fade" id="exportModal">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">
                    <h5>Export Student</h5>
                </div>

                <div class="modal-body">

                    <div class="form-check">
                        <input class="form-check-input export-column" type="checkbox" value="student_number" checked>
                        <label>Student Number</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input export-column" type="checkbox" value="full_name" checked>
                        <label>Student Name</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input export-column" type="checkbox" value="email" checked>
                        <label>Email</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input export-column" type="checkbox" value="birth_date" checked>
                        <label>Date of Birth</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input export-column" type="checkbox" value="is_active" checked>
                        <label>Status</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input export-column" type="checkbox" value="gender" checked>
                        <label>Gender</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input export-column" type="checkbox" value="address" checked>
                        <label>Address</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input export-column" type="checkbox" value="created_at">
                        <label>Created At</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input export-column" type="checkbox" value="updated_at">
                        <label>Updated At</label>
                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button class="btn btn-success" onclick="exportExcel()">
                        Export
                    </button>

                </div>

            </div>

        </div>

    </div>

    <div class="modal fade" id="importModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Import Student</h5>
                </div>

                <div class="modal-body">

                    <form id="form-import">

                        @csrf

                        <input type="file" id="file" name="file" class="form-control" accept=".xlsx,.xls,.csv"
                            required>

                        <small class="text-muted">
                            Supported: xlsx, xls, csv
                        </small>

                    </form>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button class="btn btn-primary" onclick="importStudent()">
                        Import
                    </button>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('js_custom')
    <script>
        $(function() {

            loadStudents();

        });

        function loadStudents() {
            $.ajax({

                url: "{{ route('api.student.all') }}",
                type: "GET",

                success: function(response) {
                    console.log(response.data)
                    let rows = response.data.map(function(item) {

                        return {

                            id: item.id,

                            student_number: item.student_number,
                            full_name: item.full_name,
                            email: item.email,
                            address: item.address,

                            gender: item.gender ?? '-',

                            status: item.is_active ?
                                '<span class="badge bg-success">Active</span>' :
                                '<span class="badge bg-danger">Inactive</span>',

                            action: '<a href="/student/detail/' + item.id +
                                '" class="btn btn-primary btn-sm me-1">View</a>' +
                                '<a href="/student/edit/' + item.id +
                                '" class="btn btn-warning btn-sm me-1">Edit</a>' +
                                '<button class="btn btn-danger btn-sm" onclick="deleteStudent(' + item
                                .id +
                                ')">Delete</button>'

                        };

                    });

                    $('#dg-student').datagrid('loadData', rows);

                }

            });
        }

        function deleteStudent(id) {
            if (!confirm('Delete this student?'))
                return;

            $.ajax({

                url: '/api/student/destroy/' + id,

                type: 'GET',

                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },

                success: function(response) {

                    alert(response.message);

                    loadStudents();

                },

                error: function(xhr) {

                    alert(xhr.responseJSON.message);

                }

            });
        }

        function checkExportStatus(filename) {
            console.log('HERE');
            let interval = setInterval(function () {

                $.get('/api/student/export/status/' + filename, function (res) {
                    console.log(res);
                    console.log(filename);
                    if (res.ready) {

                        clearInterval(interval);

                        window.location.href = res.url;

                    }

                });

            }, 3000); // cek tiap 3 detik

        }

        function showExportModal() {
            $('#exportModal').modal('show');
        }

        function exportExcel() {

            let columns = [];

            $('.export-column:checked').each(function() {

                columns.push($(this).val());

            });

            $.ajax({

                url: "{{ route('api.student.export') }}",

                type: "POST",

                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    columns: columns
                },

                success: function(res) {

                    alert(res.message);

                    $('#exportModal').modal('hide');

                    checkExportStatus(res.filename);
                }

            });

        }

        function showImportModal() {
            $('#importModal').modal('show');
        }

        function importStudent() {

            let formData = new FormData();

            formData.append(
                'file',
                $('#file')[0].files[0]
            );

            $.ajax({

                url: '/api/student/import',

                type: 'POST',

                data: formData,

                processData: false,

                contentType: false,

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success(res) {

                    alert(res.message);

                    $('#importModal').modal('hide');

                },

                error(xhr) {

                    alert(xhr.responseJSON.message);

                }

            });

        }
    </script>
@endsection
