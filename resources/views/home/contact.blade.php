@extends('layouts.master')

@section('title')
    Contact
@endsection

@section('content')

    <div class="py-5">
        <h2>Contact</h2>
        <p class="lead">Questions? Email us at</p>
        <a class="btn btn-lg btn-primary" href="mailto://{{ $email }}" role="button">{{ $email }} »</a>
    </div>

@endsection