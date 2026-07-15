@extends('layouts.main')

@section('title')
    Eduxamp | Edit Major
@endsection

@section('content')
<div class="flex-grow-1 p-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Major</h4>
        </div>

        <div class="card-body">

            <form id="form-major">

                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Major Name
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="major_name"
                        name="major_name">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">
                        Major Code
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="major_code"
                        name="major_code">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">
                        Faculty
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="faculty"
                        name="faculty">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        class="form-control"
                        id="description"
                        name="description"
                        rows="3"></textarea>
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

                    <a href="{{ route('major.index') }}"
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

const majorId = window.location.pathname.split('/')[3];

$(function () {

    loadMajor();

});

function loadMajor()
{
    $.ajax({

        url: '/api/major/find/' + majorId,
        type: 'GET',

        success: function(response){
            
            $('#major_name').val(response.data.major_name);
            $('#major_code').val(response.data.major_code);
            $('#faculty').val(response.data.faculty);
            $('#description').val(response.data.description);
            $('#is_active').val(response.data.is_active ? '1' : '0');

        },

        error: function(){
            console.log(majorId);
            alert('Failed to load major.');

        }

    });
}

$('#form-major').submit(function(e){

    e.preventDefault();

    $.ajax({

        url: '/api/major/update/' + majorId,
        type: 'POST',

        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            major_name: $('#major_name').val(),
            major_code: $('#major_code').val(),
            faculty: $('#faculty').val(),
            description: $('#description').val(),
            is_active: $('#is_active').val()
        },

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