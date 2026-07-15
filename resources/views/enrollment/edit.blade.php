@extends('layouts.main')

@section('title')
    Eduxamp | Edit Enrollment
@endsection

@section('content')
<div class="flex-grow-1 p-4">

    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Enrollment</h4>
        </div>

        <div class="card-body">

            <form id="form-enrollment">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Enrollment Number</label>
                    <input
                        type="text"
                        id="enrollment_number"
                        class="form-control"
                        disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Student Number<span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        id="student_number_snapshot"
                        class="form-control"
                        disabled>
                </div>

				<div class="mb-3">
                    <label class="form-label">
                        Student Name<span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        id="student_name_snapshot"
                        class="form-control"
                        disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Major <span class="text-danger">*</span>
                    </label>

					<input
                        type="text"
                        id="major_name_snapshot"
                        class="form-control"
                        disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="form-select">

                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>

                    </select>
                </div>

                <div class="text-end">
                    <a
                        href="{{ route('enrollment.index') }}"
                        class="btn btn-secondary">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header">
            Alteration History
        </div>

        <div class="card-body">

            <table
                id="dg-history"
                class="easyui-datagrid"
                style="width:100%;height:350px"
                data-options="
                    fitColumns:true,
                    singleSelect:true,
                    rownumbers:true">

                <thead>

                    <tr>

                        <th data-options="field:'created_at'" width="170">
                            Date
                        </th>

                        <th data-options="field:'name'" width="120">
                            Name
                        </th>
                        
                        <th data-options="field:'event'" width="120">
                            Event
                        </th>
                        
						<th data-options="field:'source'" width="120">
                            Source
                        </th>

                        <th data-options="field:'field'" width="150">
                            Field
                        </th>

                        <th data-options="field:'old_value'" width="220">
                            Old Value
                        </th>

                        <th data-options="field:'new_value'" width="220">
                            New Value
                        </th>

                    </tr>

                </thead>

            </table>

        </div>
    </div>

</div>
@endsection

@section('js_custom')

<script>

const enrollmentId = "{{ request()->segment(3) }}";

$(function(){
	loadEnrollment();
	loadHistory();
});

function loadHistory(){

    $.get(
        "{{ url('/api/enrollment/history') }}/" + enrollmentId,
        function(response){

            $('#dg-history').datagrid('loadData', response.data);

        }
    );

}

function loadEnrollment(){

    $.get('/api/enrollment/find/' + enrollmentId, function(response){

        const e = response.data;
        
        $('#enrollment_number').val(e.enrollment_number);

        $('#status').val(e.status);

        $('#student_number_snapshot').val(e.student_number_snapshot);
        $('#student_name_snapshot').val(e.student_name_snapshot);
        $('#major_name_snapshot').val(e.major_name_snapshot);
    });

}

$('#form-enrollment').submit(function(e){

    e.preventDefault();

    $.ajax({

        url: '/api/enrollment/update/' + enrollmentId,

        type: 'POST',

        data: $(this).serialize() + '&_method=POST',

        success: function(response){

            alert(response.message);

            location.reload();

        },

        error: function(xhr){

            alert(xhr.responseJSON.message);

        }

    });

});

</script>

@endsection