@extends('layouts.main')

@section('title')
    Eduxamp | Create Role
@endsection

@section('css_custom')
@endsection

@section('content')
<div class="flex-grow-1 p-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">New Role</h4>
        </div>

        <div class="card-body">

            <form id="form-role">

                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">
                        Role Name <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
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

                    <a href="{{ route('role.index') }}"
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

$('#form-role').submit(function(e){

    e.preventDefault();

    $.ajax({

        url: "{{ route('api.role.store') }}",
        type: "POST",
        data: $(this).serialize(),

        success: function(response){

            alert(response.message);

            window.location.href = "{{ route('role.index') }}";

        },

        error: function(xhr){

            alert(xhr.responseJSON.message);

        }

    });

});

</script>
@endsection