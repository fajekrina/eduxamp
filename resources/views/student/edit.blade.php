@extends('layouts.main')

@section('title')
    Eduxamp | Edit Student
@endsection

@section('content')
<div class="flex-grow-1 p-4">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4 class="mb-0">Edit Student</h4>
        </div>

        <div class="card-body">

            <form id="form-student" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Student Number
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="student_number"
                        disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Full Name <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="full_name"
                        name="full_name"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Gender <span class="text-danger">*</span>
                    </label>

                    <select
                        class="form-select"
                        id="gender"
                        name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Birth Date <span class="text-danger">*</span>
                    </label>

                    <input
                        type="date"
                        class="form-control"
                        id="birth_date"
                        name="birth_date">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Email <span class="text-danger">*</span>
                    </label>

                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Phone <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="phone"
                        name="phone">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Address
                    </label>

                    <textarea
                        class="form-control"
                        id="address"
                        name="address"
                        rows="3"></textarea>
                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Current Transcript
                    </label>

                    <div>
                        <a
                            id="btn-transcript"
                            href="#"
                            target="_blank"
                            class="btn btn-outline-primary btn-sm d-none">
                            View Current Transcript
                        </a>

                        <span
                            id="transcript-empty"
                            class="text-muted">
                            No transcript uploaded.
                        </span>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Replace Transcript (PDF only, 100 KB - 500 KB)
                    </label>

                    <input
                        type="file"
                        class="form-control"
                        id="transcript"
                        name="transcript"
                        accept=".pdf,application/pdf">

                    <small class="text-muted">
                        Leave empty if you don't want to replace the transcript.
                    </small>
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
                        href="{{ route('student.index') }}"
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

</div>
@endsection

@section('js_custom')

<script>

const studentId = "{{ request()->segment(3) }}";

$(function () {

    loadStudent();

});

function loadStudent()
{
    $.ajax({

        url: "/api/student/find/" + studentId,

        type: "GET",

        success: function(response){

            const student = response.data;
            
            $('#student_number').val(student.student_number);
            $('#full_name').val(student.full_name);
            $('#gender').val(student.gender);
            $('#birth_date').val(student.birth_date.split('T')[0]);
            $('#email').val(student.email);
            $('#phone').val(student.phone);
            $('#address').val(student.address);
            $('#is_active').val(student.is_active ? '1' : '0');

            if(student.transcript_file){

                $('#btn-transcript')
                    .attr('href', '/transcript/' + student.transcript_file)
                    .removeClass('d-none');

                $('#transcript-empty').hide();

            }

        },

        error:function(){

            alert('Failed to load student.');

        }

    });
}

$('#form-student').submit(function(e){

    e.preventDefault();

    const file = $('#transcript')[0].files[0];

    if(file){

        const min = 100 * 1024;
        const max = 500 * 1024;

        if(file.type !== 'application/pdf'){
            alert('Transcript must be a PDF file.');
            return;
        }

        if(file.size < min || file.size > max){
            alert('Transcript size must be between 100 KB and 500 KB.');
            return;
        }

    }

    let formData = new FormData(this);

    formData.append('_method', 'POST');

    $.ajax({

        url: "/api/student/update/" + studentId,

        type: "POST",

        data: formData,

        processData: false,

        contentType: false,

        success:function(response){

            alert(response.message);

            window.location.href = "{{ route('student.index') }}";

        },

        error:function(xhr){

            alert(xhr.responseJSON.message);

        }

    });

});

</script>

@endsection