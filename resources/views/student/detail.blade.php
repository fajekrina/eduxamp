@extends('layouts.main')

@section('title')
    Eduxamp | Student Detail
@endsection

@section('content')

<div class="flex-grow-1 p-4">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4>Student Detail</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="220">Full Name</th>
                    <td id="full_name"></td>
                </tr>

                <tr>
                    <th>Gender</th>
                    <td id="gender"></td>
                </tr>

                <tr>
                    <th>Birth Date</th>
                    <td id="birth_date"></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td id="email"></td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td id="phone"></td>
                </tr>

                <tr>
                    <th>Address</th>
                    <td id="address"></td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td id="status"></td>
                </tr>

                <tr>
                    <th>Latest Transcript</th>
                    <td id="transcript"></td>
                </tr>

            </table>

            <a
                href="{{ route('student.index') }}"
                class="btn btn-secondary">
                Back
            </a>

        </div>

    </div>

</div>

@endsection

@section('js_custom')

<script>

const studentId = window.location.pathname.split('/')[3];

$(function(){

    $.ajax({

        url: "/api/student/find/" + studentId,

        type: "GET",

        success:function(response){

            const s = response.data;
          console.log(s);
            $('#full_name').text(s.full_name);
            $('#gender').text(s.gender);
            $('#birth_date').text(s.birth_date);
            $('#email').text(s.email);
            $('#phone').text(s.phone);
            $('#address').text(s.address);
            $('#status').html(
                s.is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>'
            );

            if(s.transcript_file){

                $('#transcript').html(
                    `<a href="/transcript/${s.transcript_file}"
                        target="_blank"
                        class="btn btn-primary btn-sm">
                        View Latest Transcript
                    </a>`
                );

            }else{

                $('#transcript').html(
                    '<span class="text-muted">No transcript uploaded.</span>'
                );

            }

        }

    });

});

</script>

@endsection