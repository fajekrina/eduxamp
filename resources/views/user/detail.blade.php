@extends('layouts.main')

@section('title')
    Eduxamp | Detail User
@endsection

@section('content')
    <div class="flex-grow-1 p-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Detail User</h4>
            </div>

            <div class="card-body">

                <form id="form-user">
                    <div class="mb-3">
                        <label class="form-label">
                            Name
                        </label>

                        <input type="text" class="form-control" id="name" name="name" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Email
                        </label>

                        <input type="text" class="form-control" id="email" name="email" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Role
                        </label>

                        <input type="text" class="form-control" id="role" name="role" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Status
                        </label>

                        <select class="form-select" id="is_active" name="is_active" disabled>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-start gap-2">

                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            Back
                        </a>

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

            loadUser();

        });

        function loadUser() {
            $.ajax({

                url: '/api/user/find/' + userId,
                type: 'GET',

                success: function(response) {
                    console.log(response.data);
                    $('#name').val(response.data.name);
                    $('#email').val(response.data.email);
                    $('#role').val(response.data.role.name);
                    $('#is_active').val(response.data.is_active ? '1' : '0');

                },

                error: function() {
                    console.log(userId);
                    alert('Failed to load user.');

                }

            });
        }
    </script>
@endsection
