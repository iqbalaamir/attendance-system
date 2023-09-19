@extends('layouts.app')

@section('content')
    <h1 class="text-center">Attendance List</h1>
    <div class="table-container">
        <table class="table table-bordered table-striped" id="attendanceTable">
            <thead class="thead-dark">
                <tr>
                    <th>Emp ID</th>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Status</th>
                    <th>Sandwich Affected</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->emp_id }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->day }}</td>
                    <td>{{ $attendance->status }}</td>
                    <td>{{ $attendance->sandwichAffected ? 'Yes' : 'No' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('styles')
    <style>
        .table-container {
            margin: auto;
            width: 80%;
        }
    </style>
@endsection



@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#attendanceTable').DataTable();
        });
    </script>
@endsection
