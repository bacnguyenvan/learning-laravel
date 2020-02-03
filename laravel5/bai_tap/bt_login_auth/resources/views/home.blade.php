@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    
                    <p class="alert alert-success">Hello {{Auth::user()->name}}</p>
                    
                </div>
            </div>
        </div>
    </div>
    
    <div class="">
        <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit()  ">Logout</a>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
</div>
@endsection

@section('title','Home')