@extends('layouts.app')
@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 ">
<div class="card">
<div class="card-header">Found items:
  <select style=" float:right;  margin:5px;" id="category">
<option value="Jewellery">Jewellery</option>
<option value="Pets">Pets</option>
<option value="Electronic devices">Electronic Devices</option>
<option value=''>All</option>
</select>
  <button onclick="myFunction()" style="  float:right; border-radius: 3px; border-width: thin;margin:5px;" id="refreshBtn" type="button" onclick="items" name="refresh">Refresh</button>
</div>
<div class="card-body">
<table id ="myTable"class="table table-striped">
<thead>
<tr>
<th>Item Name</th>
<th>Category</th>
<th>Colour</th>
<th>Description</th>
<th colspan="3">Actions</th>
</tr>
</thead>
<tbody>
@foreach($items as $item)
<tr>
<td>{{$item['ItemName']}}</td>
<td>{{$item['Category']}}</td>
<td>{{$item['Colour']}}</td>
<td>{{$item['Description']}}</td>
@guest
<td><a onclick="window.alert('Please log in to use this feature.');" class="btn
btn- primary">Details</a></td>
<td><a onclick="window.alert('Please log in to use this feature.');" class="btn
btn- primary">Request item</a></td>
@else
<td><a href="{{action('ItemController@show', $item['id'])}}" class="btn
btn- primary">Details</a></td>
<td><a href="{{action('ItemController@show', $item['id'])}}" class="btn
btn- primary">Request item</a></td>
@if(Auth::user()->role =='1')
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
@endif
@endguest
@endforeach
</tbody>
</table>
@guest
@else
<a style="float:right;" href="create" class="btn
btn- primary"><button>Add item</button></a>
@if(Auth::user()->role =='1')
<a style="float:right;" href="{action('ItemController@show', 1}" class="btn
btn- primary"><button>See requests</button></a>
@endif
@endguest
</div>
</div>
</div>
</div>
</div>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("category");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

@endsection
