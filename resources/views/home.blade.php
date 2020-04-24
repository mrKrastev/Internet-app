@extends('layouts.app')
<link rel="stylesheet" href="./css/filodefaultcss.css">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Welcome to Found and Lost items website!</h1></div>

                <div class="card-body" style="display:flex;flex-wrap:wrap;justify-content:center;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <img src="media/lost items img.jpg" alt="lost items?" width=400 height=400>
                    <a class="navbar-brand" href="{{ url('items') }}">
                      <h2 style="color:Black;"><strong><u>Check what we've found!</u></strong></h2>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
