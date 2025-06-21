@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>Contact Form</h2>
            <form>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
@endsection