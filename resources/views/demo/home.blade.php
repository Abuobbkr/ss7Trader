@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="jumbotron">
        <h1>Welcome to {{ config('app.name') }}</h1>
        <p>This is a demo home page using your template.</p>
    </div>
@endsection

@section('scripts')
    <script>
        console.log('Homepage loaded!');
    </script>
@endsection