@extends('layouts.app')
<!-- define the content section -->
@section('content')
<!-- Making sure that if the user isnt logged in, he doesnt see any of the content (he shouldnt be able to navigate here anyway) -->
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
 <div class="card-header">Add an item you have found:</div>
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
<div class="card-body">
<form class="form-horizontal" method="POST"
action="{{url('items') }}" enctype="multipart/form-data">
@csrf
 <div class="col-md-8">
 <label >What is the item?</label>
<input type="text" name="ItemName"
placeholder="eg. a phone" />
 </div>
 <div class="col-md-8">
<label>In which category would the item be?</label>
<select name="Category" >
<option value="Jewellery">Jewellery</option>
<option value="Electronic Devices">Electronic Devices</option>
<option value="Pets">Pets</option>
</select>
</div>
<div class="col-md-8">
<label >Colour</label>
<input type="text" name="Colour"
placeholder="eg. Red" />
</div>
<div class="col-md-8">
<label >Where have you found the item?</label>
<input type="text" name="Location"
placeholder="eg on bus route 3, Birmingham" />
</div>
<div class="col-md-8">
<label >When have you found the item?</label>
<input type="datetime-local" id="birthdaytime" name="Date">
</div>
<div class="col-md-8">
<label >Description:</label>
<textarea rows="4" cols="50" name="Description">...</textarea>
</div>
<div>
<label >Found By:</label>
<!-- readonly input as we just want to show them that their name is being recorded when adding the item -->
<input type="text" name="FoundBy" value="{{Auth::user()->name}}" readonly="true"/>
</div>
<div class="col-md-8">
<label>Pictures</label>
<input type="file" name="Picture[]"
placeholder="Image file" multiple />
</div>
<div class="col-md-6 col-md-offset-4">
<input type="submit" class="btn btn-primary" />
<input type="reset" class="btn btn-primary" />
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endguest
@endsection
