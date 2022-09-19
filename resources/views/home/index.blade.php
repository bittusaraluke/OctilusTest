@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <h2>Welcome !</h2>
        <!-- <p class="lead">Only authenticated users can access this section.</p> -->
        <p class="">Laravel Version used: Laravel 8</p>
        @endauth

        @guest
        <h1>Homepage</h1>


        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection
