@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1>Apply for Leave</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('store.leave')}}">
                            @csrf
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="reason">Reason for Leave</label>
                                <textarea id="reason" name="reason" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Apply for Leave</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
