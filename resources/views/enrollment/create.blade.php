@extends('layouts.main')

@section('title')
    Eduxamp | New Enrollment
@endsection

@section('content')
<div class="flex-grow-1 p-4">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4 class="mb-0">New Enrollment</h4>
        </div>

        <div class="card-body">

            <form id="form-enrollment">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Student <span class="text-danger">*</span>
                    </label>

                    <select
                        class="form-select"
                        id="student_id"
                        name="student_id"
                        required>
                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Major <span class="text-danger">*</span>
                    </label>

                    <select
                        class="form-select"
                        id="major_id"
                        name="major_id"
                        required>
                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        class="form-select"
                        id="is_active"
                        name="is_active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('enrollment.index') }}"
                        class="btn btn-secondary">
                        Cancel
                    </a>

                    <button
                        class="btn btn-primary"
                        type="submit">
                        Save
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection

@section('js_custom')

<script>

$(function(){

    loadStudents();

    loadMajors();

});

function loadStudents(){

    $.get("{{ route('api.student.all') }}", function(response){

        let option = '<option value="">-- Select Student --</option>';

        response.data.forEach(function(student){

            option += `
                <option value="${student.id}">
                    ${student.student_number} - ${student.full_name}
                </option>
            `;

        });

        $('#student_id').html(option);

    });

}

function loadMajors(){

    $.get("{{ route('api.major.all') }}", function(response){

        let option = '<option value="">-- Select Major --</option>';

        response.data.forEach(function(major){

            option += `
                <option value="${major.id}">
                    ${major.major_name}
                </option>
            `;

        });

        $('#major_id').html(option);

    });

}

$('#form-enrollment').submit(function(e){

    e.preventDefault();

    $.ajax({

        url: "{{ route('api.enrollment.store') }}",

        type: "POST",

        data: $(this).serialize(),

        success:function(response){

            alert(response.message);

            window.location.href="{{ route('enrollment.index') }}";

        },

        error:function(xhr){

            alert(xhr.responseJSON.message);

        }

    });

});

</script>

@endsection