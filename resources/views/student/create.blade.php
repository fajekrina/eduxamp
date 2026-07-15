@extends('layouts.main')

@section('title')
    Eduxamp | Create Student
@endsection

@section('css_custom')
@endsection

@section('content')
    <div class="flex-grow-1 p-4">

        <div class="card shadow-sm">

            <div class="card-header">
                <h4 class="mb-0">New Student</h4>
            </div>

            <div class="card-body">

                <form id="form-student" enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label">
                            Full Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Gender <span class="text-danger">*</span>
                        </label>

                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">-- Select Gender --</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Birth Date <span class="text-danger">*</span>
                        </label>

                        <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Email <span class="text-danger">*</span>
                        </label>

                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Phone <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Address
                        </label>

                        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Transcript
                            <span class="text-danger">*</span>
                        </label>

                        <input type="file" class="form-control" id="transcript" name="transcript"
                            accept=".pdf,application/pdf">

                        <small class="text-muted">
                            Only PDF files with size between 100 KB and 500 KB are allowed.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Status
                        </label>

                        <select class="form-select" id="is_active" name="is_active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('student.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary">
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
        $('#form-student').submit(function(e) {

            e.preventDefault();

            const file = $('#transcript')[0].files[0];

            if (file) {
                const maxSize = 500 * 1024;
                const minSize = 100 * 1024;

                if (file.type !== 'application/pdf') {
                    alert('Transcript must be a PDF file.');
                    return;
                }

                if (file.size < minSize || file.size > maxSize) {
                    alert('Transcript size must be between 100 KB and 500 KB.');
                    return;
                }

            }

            let formData = new FormData(this);

            $.ajax({

                url: "{{ route('api.student.store') }}",

                type: "POST",

                data: formData,

                processData: false,

                contentType: false,

                success: function(response) {

                    alert(response.message);

                    window.location.href = "{{ route('student.index') }}";

                },

                error: function(xhr) {

                    alert(xhr.responseJSON.message);

                }

            });

        });
    </script>
@endsection
