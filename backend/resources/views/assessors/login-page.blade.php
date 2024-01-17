@extends('assessors/layouts/app')

@section('title', 'Assessor Login Page')

@section('content')

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #393081 !important;
            margin: 0;
            padding: 0;
        }

        .header {
            padding: 20px;
            background-color: white;
        }

        .logo {
            width: 200px;
            height: 60px;
            margin-right: 10px;
        }

        .container {
            max-width: 400px;
            width: 90%;
            /* Adjust as needed */
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            text-align: left;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .register-link {
            display: block;
            margin-top: 10px;
            color: #4caf50;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            .container {
                width: 100%;
            }
        }
    </style>

    {{-- <div class="header">
        <img src="{{ asset('images/um-logo.png') }}" alt="Logo" class="logo">
        <h2>Your Company Name</h2>
    </div> --}}

    <div class="header">
        <div class="d-flex justify-content-between mx-3 my-3" style="background-color:white;">
            <div>
                <img src="{{ asset('images/um-logo.png') }}" alt="Logo" class="logo">
            </div>
            <div></div>
            <div class="text-right">
                <h5>Quality Management and Enhancement Centre (QMEC)<br>
                    Assessor Login Page
                </h5>
            </div>
        </div>
    </div>

    <div class="container">
        <form method="POST" action="{{ route('assessors.login') }}">
            @csrf

            <label>Please enter the details of the account that is associated with your email/ siswamail
            </label>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-group mt-3">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>

        <a href="{{ route('assessors.register.page') }}" class="register-link">Register</a>
    </div>
