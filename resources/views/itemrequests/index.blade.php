@extends('layouts.app')
@section('content')
@guest

@else
  <!--dont allow anyone but the admin to see this page-->
@if(Auth::user()->role =='1')
@if (\Session::has('success'))
<div class="alert alert-success">
<p>{{ \Session::get('success') }}</p>
</div><br /> @endif

<div class="container">
<div class="row justify-content-center">
<div class="col-md-12 ">
<div class="card">
<div class="card-header">Requests:</div>
<div class="card-body">
<table id ="myTable"class="table table-striped">
<thead>
<tr>
<th>Request ID</th>
<th>User ID</th>
<th>Item ID</th>
<th>Created At</th>
<th>Updated at</th>
<th>Status</th>
<th colspan="3">Actions</th>
</tr>
</thead>
<tbody>
@foreach($itemrequests as $request)
<!-- showing all requests -->
<tr>
<td style ="word-break:break-word;">{{$request['id']}}</td>
<td style ="word-break:break-word;">{{$request['userid']}}</td>
<td style ="word-break:break-word;">{{$request['itemid']}}</td>
<td style ="word-break:break-word;">{{$request['created_at']}}</td>
<td style ="word-break:break-word;">{{$request['updated_at']}}</td>
<td style ="word-break:break-word;">{{$request['Status']}}</td>


            <td><a href="{{action('ItemRequestController@edit', $request['id'])}}" class="btn
            btn- primary">Review</a></td>
           <td><form action="{{action('ItemRequestController@destroy', $request['id'])}}"
           method="post"> @csrf
           <input name="_method" type="hidden" value="DELETE">
           <button class="btn btn-danger" type="submit">Delete</button>
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
@endif
@endguest
