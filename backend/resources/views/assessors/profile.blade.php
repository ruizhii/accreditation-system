@extends('assessors/layouts/app')

@section('title', 'Assessor Areas')

@section('content')
    @include('assessors/layouts/nav')

    <div class="container content text-center">
        <h3 class="text-center mb-3">Profile</h3>
        <hr>

        @if (session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('assessors.profile.update') }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Institution Name</label>
                <input type="text" class="form-control" name="institution_name"
                    value="{{ auth('assessors')->user()->institution_name }}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Telephone Number:</label>
                <input type="text" class="form-control" name="telephone_no"
                    value="{{ auth('assessors')->user()->telephone_no }}" required>
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" name="email" value="{{ auth('assessors')->user()->email }}" required>
            </div>
            <div class="form-group">
                <label>Password <small><i>(leave password blank if not changing password)</i></small></label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script></script>
