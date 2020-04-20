@extends('layouts.app')
@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 ">
<div class="card">
<div class="card-header">Found items:
  <select style="  float:right;  margin:5px;" id="category">
<option value="Jewellery">Jewellery</option>
<option value="Pets">Pets</option>
<option value="Electronic devices">Electronic Devices</option>
</select>
  <button style="  float:right; border-radius: 3px; border-width: thin;margin:5px;" id="refreshBtn" type="button" onclick="items" name="refresh">Refresh</button>
</div>
<div class="card-body">
<table class="table table-striped">
<thead>
<tr>
<th>Item Name</th>
<th>Category</th>
<th>Colour</th>
<th>Description</th>
<th colspan="3">Action</th>
</tr>
</thead>
<tbody>
@foreach($items as $item)
<tr>
<td>{{$item['ItemName']}}</td>
<td>{{$item['Category']}}</td>
<td>{{$item['Colour']}}</td>
<td>{{$item['Description']}}</td>
<td><a href="{{action('ItemController@show', $item['id'])}}" class="btn
btn- primary">Details</a></td>
<td><a href="{{action('ItemController@edit', $item['id'])}}" class="btn
btn- warning">Edit</a></td>
<td>
<form action="{{action('ItemController@destroy', $item['id'])}}"
method="post"> @csrf
<input name="_method" type="hidden" value="DELETE">
<button class="btn btn-danger" type="submit"> Delete</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
@endsection
