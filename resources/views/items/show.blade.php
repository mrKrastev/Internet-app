@extends('layouts.app')
<!-- define the content section -->
@guest
<div class="card">
  <img src="https://i.ytimg.com/vi/HyHT0tKSl5Y/maxresdefault.jpg" alt="">
  <h1>NEVER SHOULD HAVE COME HERE!</h1>
</div>
@else
@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 ">
<div class="card">
<div class="card-header">Item details:</div>
<div class="card-body">
<table class="table table-striped" border="1" >
<tr> <td> <b>Item ID :</th> <td> {{$item['id']}}</td></tr>
  <tr> <td><b>Item Name :</th> <td> {{$item['ItemName']}}</td></tr>
<tr> <th><b>Item category: </th> <td>{{$item->Category}}</td></tr>
<tr> <th><b>Colour: </th> <td>{{$item->Colour}}</td></tr>
<tr> <td><b>Date found:</th> <td>{{$item->Date}}</td></tr>
<tr> <th><b>Description</th> <td style="max-width:150px;" >{{$item->Description}}</td></tr>
  <?php
  $str=$item->Pictures;
  $manyurls=explode(",",$str);
    ?>
    <div style="display:flex; flex-wrap:wrap;">
@foreach($manyurls as $url)
<tr> <td colspan='2' ><img style="max-width:80%;max-height:80%"
src="{{ asset('storage/images/'.$url)}}"></td></tr>
@endforeach
</div>
</table>
<table><tr>
<td><a href="/items" class="btn btn-primary" role="button">Back to the
list</a></td>
<td><a href="{{action('ItemController@show', $item['id'])}}" class="btn
btn- primary">Request item</a></td>
@if(Auth::user()->role =='1')
<td><a href="{{action('ItemController@edit', $item['id'])}}" class="btn
btn- warning">Edit</a></td>
<td><form action="{{action('ItemController@destroy', $item['id'])}}"
method="post"> @csrf
<input name="_method" type="hidden" value="DELETE">
<button class="btn btn-danger" type="submit">Delete</button>
@endif
</form></td>
</tr></table>
</div>
</div>
</div>
</div>
</div>
@endsection
@endguest
