@extends('layouts.app')
<!-- Making sure that if the user isnt logged in, he doesnt see any of the content (he shouldnt be able to navigate here anyway) -->
@guest
<div class="card">
  <img src="https://i.ytimg.com/vi/HyHT0tKSl5Y/maxresdefault.jpg" alt="">
  <h1>NEVER SHOULD HAVE COME HERE!</h1>
</div>
@else
@if(Auth::user()->role =='1')
@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 ">
<div class="card">
<div class="card-header">Edit and update the item</div>
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
  <!-- embedding blade inside values everywhere to make it easier to keep the initial values the same if no change is needed there -->
<form class="form-horizontal" method="POST" action="{{ action('ItemController@update',
$item['id']) }} " enctype="multipart/form-data" >
@method('PATCH')
@csrf
<div class="col-md-8">
<label >Item Name</label>
<input type="text" name="ItemName" value="{{$item->ItemName}}"/>
</div>
<div class="col-md-8">
<label>Category</label>
<select name="Category" value="{{ $item->Category }}">
<option value="Jewellery">Jewellery</option>
<option value="Pets">Pets</option>
<option value="Electronic Devices">Electronic Devices</option>
</select>
</div>
<div class="col-md-8">
<label >Colour</label>
<input type="text" name="Colour" value="{{$item->Colour}}" />
</div>
<div class="col-md-8">
<label >Location</label>
<input type="text" name="Location" value="{{$item->Location}}" />
</div>
<div class="col-md-8">
  <div class="col-md-8">
<label>Date found:</label><input type="text" value="{{$item->Date}}" disabled/>
</div>
<label >New Date(optional):</label>
<input type="datetime-local" name="Date" value="{{$item->Date}}"/>
</div>
<div class="col-md-8">
<label >Description</label>
<textarea rows="4" cols="50" name="Description" > {{$item->Description}}
</textarea>
</div>
<div class="col-md-8">
<label>Image</label>
<input type="file" name="Picture[]" multiple />
</div>
<div class="col-md-6 col-md-offset-4">
<input type="submit" class="btn btn-primary" />
<input type="reset" class="btn btn-primary" />
</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection
@endif
@endguest
