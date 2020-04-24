@extends('layouts.app')
@guest

@else
  <!--dont allow anyone but the admin to see this page-->
@if(Auth::user()->role =='1')
@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 ">
<div class="card">
<div class="card-header">Review request:</div>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div><br />
@endif
@if (\Session::has('success'))
<div class="alert alert-success">
<p>{{ \Session::get('success') }}</p>
</div><br />
@endif
<div class="card-body">
<form class="form-horizontal" method="POST" action="{{ action('ItemRequestController@update',$request->id)}} " enctype="multipart/form-data" >
@method('PATCH')
@csrf
<div class="col-md-8">
<label >Request ID</label>
<input type="text" name="requestid" value="{{$request->id}}" disabled/>
</div>
<div class="col-md-8">
<label >User ID</label>
<input type="text" name="userid" value="{{$request->userid}}" readonly/>
</div>
<div class="col-md-8">
<label >Reason for requesting</label>
<textarea rows="4" cols="50" name="reason" disabled > {{$request->Reason}}
</textarea>
</div>
<div class="col-md-8">
  <!--allow the admin to edit the status of the request-->
<label >Select decision:</label>
<select name="status" id="outcome">
<option value="Pending">Pending</option>
<option value="Approved">Approved</option>
<option value="Declined">Declined</option>
</select>
</div>
<div class="col-md-6 col-md-offset-4">
<input type="submit" class="btn btn-primary" value="Confirm">

</a>
</div>
</form>
<a style="color:black; float:right;" href="{{ url('itemrequests') }}"><u>Back</u><a/>
</div>
</div>
</div>
</div>
</div>
@endsection
@endif
@endguest
