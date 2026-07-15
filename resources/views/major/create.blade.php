@extends('layouts.main')

@section('title')
    Eduxamp | Create Major
@endsection

@section('css_custom')
@endsection

@section('content')
<div class="flex-grow-1 p-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">New Major</h4>
        </div>

        <div class="card-body">

            <form id="form-major">

                @csrf

                <div class="mb-3">
                    <label for="major_code" class="form-label">
                        Major Code <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        id="major_code"
                        name="major_code"
                        placeholder="Enter role name"
                        required
                    >
                </div>
                
                <div class="mb-3">
                    <label for="major_name" class="form-label">
                        Major Name <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        id="major_name"
                        name="major_name"
                        placeholder="Enter role name"
                        required
                    >
                </div>
                
                <div class="mb-3">
                    <label for="faculty" class="form-label">
                        Faculty <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        id="faculty"
                        name="faculty"
                        placeholder="Enter role name"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">
                        Description
                    </label>
                    <textarea
                        class="form-control"
                        id="description"
                        name="description"
                        rows="3"
                        placeholder="Enter description"></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('major.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary">
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

$('#form-major').submit(function(e){

    e.preventDefault();

    $.ajax({

        url: "{{ route('api.major.store') }}",
        type: "POST",
        data: $(this).serialize(),

        success: function(response){

            alert(response.message);

            window.location.href = "{{ route('major.index') }}";

        },

        error: function(xhr){

            alert(xhr.responseJSON.message);

        }

    });

});

</script>
@endsection