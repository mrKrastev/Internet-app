@extends('layouts.app')
@section('content')

@if (\Session::has('success'))
<div class="alert alert-success">
<p>{{ \Session::get('success') }}</p>
</div><br /> @endif

<div class="container">
<div class="row justify-content-center">
<div class="col-md-12 ">
<div class="card">
<div class="card-header">Found items:
  <!-- adding a drop down for sorting and a refresh button which updates the table -->
  <select style=" float:right;  margin:5px; color:white;" id="category">
<option style="color:black;"value="Jewellery">Jewellery</option>
<option style="color:black;"value="Pets">Pets</option>
<option style="color:black;"value="Electronic devices">Electronic Devices</option>
<option style="color:black;" value=''>All</option>
</select>
  <button onclick="myFunction()" style="  float:right; border-radius: 3px;border-color:white; border-width: thin;margin:5px; color:white;" id="refreshBtn" type="button" onclick="items" name="refresh">Refresh</button>
</div>
<div class="card-body">
<table id ="myTable"class="table table-striped">
<thead>
<tr>
<th>Item Name</th>
<th>Category</th>
<th>Colour</th>
<th style ="word-break:break-word;">Date & Time Found</th>
<th colspan="3">Actions</th>
</tr>
</thead>
<tbody>
  <!-- using blade to display all of the items in a table -->
@foreach($items as $item)
<tr>
<td style ="word-break:break-word;">{{$item['ItemName']}}</td>
<td>{{$item['Category']}}</td>
<td style ="word-break:break-word;">{{$item['Colour']}}</td>
<td style ="word-break:break-word;">{{$item['Date']}}</td>
@guest
<!-- as a guest, all that the "details"  and "request item" buttons do is alert them to log in-->
<td><a onclick="window.alert('Please log in to use this feature.');" class="btn
btn- primary">Details</a></td>
<td><a onclick="window.alert('Please log in to use this feature.');" class="btn
btn- primary">Request item</a></td>
@else
<!-- if logged in, then allow them to see the actual pages (pages are designed to work only with logged users anyway) -->
<td><a href="{{action('ItemController@show', $item['id'])}}" class="btn
btn- primary">Details</a></td>
<td><a href="{{action('ItemRequestController@create', $item['id'])}}" class="btn
btn- warning">Request item</a></td>
<td>
  <!-- here we check if the logged user is actually an admin, if so, we add the extra buttons such as edit and delete -->
@if(Auth::user()->role =='1')
           <td><a href="{{action('ItemController@edit', $item['id'])}}" class="btn
           btn- warning">Edit</a></td>
           <td>
           <form action="{{action('ItemController@destroy', $item['id'])}}"
           method="post"> @csrf
           <input name="_method" type="hidden" value="DELETE"/>
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
<!-- this button is available only for logged users so we make sure its displayed only then -->
<a style="float:right;" href="create" class="btn
btn- primary"><button>Add item</button></a>
<!-- if its an admin, we add see item requests button as well -->
@if(Auth::user()->role =='1')
<a style="float:right;" href="{{ url('itemrequests') }}" class="btn
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
  //this is the script i used to sort the table
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("category"); //gets the filter value
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr"); //gets the rows
  //loop and dont display the rows which arent of the given category
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
