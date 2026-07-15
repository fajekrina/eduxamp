@extends('layouts.main')

@section('title')
    Eduxamp | Edit User
@endsection

@section('css_custom')
@endsection

@section('content')
    <div class="flex-grow-1 p-4">

        <div class="card shadow-sm">

            <div class="card-header">
                <h4 class="mb-0">Edit User</h4>
            </div>

            <div class="card-body">

                <form id="form-user">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label">
                            Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Email <span class="text-danger">*</span>
                        </label>

                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Role
                        </label>

                        <select class="form-select" id="role_id" name="role_id">
                        </select>
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

                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
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
        const userId = window.location.pathname.split('/')[3];

        $(function() {

            loadRoles();
            loadUser();
        });

        function loadRoles() {
            $.ajax({

                url: "{{ route('api.role.all') }}",
                type: "GET",

                success: function(response) {

                    let option = '';

                    response.data.forEach(function(role) {

                        option += `
                    <option value="${role.id}">
                        ${role.name}
                    </option>
                `;

                    });

                    $('#role_id').html(option);

                }

            });
        }

        function loadUser() {
            $.ajax({

                url: '/api/user/find/' + userId,
                type: 'GET',

                success: function(response) {
                    console.log(response.data);
                    $('#name').val(response.data.name);
                    $('#email').val(response.data.email);
                    $('#role_id').val(response.data.role.id);
                    $('#is_active').val(response.data.is_active ? '1' : '0');

                },

                error: function() {
                    console.log(roleId);
                    alert('Failed to load role.');

                }

            });
        }

        $('#form-user').submit(function(e) {

            e.preventDefault();

            $.ajax({

                url: '/api/user/update/' + userId,

                type: "POST",

                data: $(this).serialize(),

                success: function(response) {

                    alert(response.message);

                    window.location.href = "{{ route('user.index') }}";

                },

                error: function(xhr) {

                    alert(xhr.responseJSON.message);

                }

            });

        });
    </script>
@endsection
