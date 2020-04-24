@extends('layouts.app')
<!-- define the content section -->
@section('content')
@guest
<div class="card">
  <img src="https://i.ytimg.com/vi/HyHT0tKSl5Y/maxresdefault.jpg" alt="">
  <h1>NEVER SHOULD HAVE COME HERE!</h1>
</div>
@else
<div class="container">
 <div class="row justify-content-center">
<div class="col-md-10 ">
 <div class="card">
 <div class="card-header">Request this item:</div>
<!-- display the errors -->
@if ($errors->any())
<div class="alert alert-danger">
<ul> @foreach ($errors->all() as $error)
<li>{{ $error }}</li> @endforeach
</ul>
</div><br /> @endif
<!-- display the success status -->
@if (\Session::has('success'))
<div class="alert alert-success">
<p>{{ \Session::get('success') }}</p>
</div><br /> @endif
 <!-- define the form -->
 <!-- all input values are read only, as they are for display purposes,however, i had to use input to get the values for the controller later-->
<div class="card-body">
<form class="form-horizontal" method="POST"
action="{{url('itemrequests') }}" enctype="multipart/form-data">
@csrf
<div class="col-md-8">
<label >Item ID</label>
<input type="text" name="itemid" value="{{$item->id}}" readonly="true"/>
</div>


<div class="col-md-8">
<label >Item Name</label>
<input type="text" name="ItemName" value="{{$item->ItemName}}" readonly="true"/>
</div>
<div>
<input type="text" name="userid" value="{{Auth::user()->name}}" readonly="true" hidden/>
</div>
<label >Reason:</label>
<textarea rows="4" cols="50" name="reason">...</textarea>
<div class="col-md-6 col-md-offset-4">
<input type="submit" class="btn btn-primary"/>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endguest
@endsection
