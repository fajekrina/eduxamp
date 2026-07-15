@extends('layouts.main')

@section('title')
    Eduxamp | Edit Role
@endsection

@section('content')
<div class="flex-grow-1 p-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Role</h4>
        </div>

        <div class="card-body">

            <form id="form-role">

                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Role Name
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name">
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

                    <a href="{{ route('role.index') }}"
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

const roleId = window.location.pathname.split('/')[3];

$(function () {

    loadRole();

});

function loadRole()
{
    $.ajax({

        url: '/api/role/find/' + roleId,
        type: 'GET',

        success: function(response){
            
            $('#name').val(response.data.name);
            $('#description').val(response.data.description);
            $('#is_active').val(response.data.is_active ? '1' : '0');

        },

        error: function(){
            console.log(roleId);
            alert('Failed to load role.');

        }

    });
}

$('#form-role').submit(function(e){

    e.preventDefault();

    $.ajax({

        url: '/api/role/update/' + roleId,
        type: 'POST',

        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: $('#name').val(),
            description: $('#description').val(),
            is_active: $('#is_active').val()
        },

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