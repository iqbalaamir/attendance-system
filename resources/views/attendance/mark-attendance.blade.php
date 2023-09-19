@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1>Mark Attendance</h1>
                    </div>
                    <div class="card-body text-center">
                        <form method="POST" action="{{route('store.attendance')}}">
                            @csrf
                            <p>Click the button below to mark your attendance as "Present" for today.</p>
                            <button type="submit" class="btn btn-primary">Mark as Present</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
