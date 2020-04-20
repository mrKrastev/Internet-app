@extends('layouts.app')
<link rel="stylesheet" href="./css/filodefaultcss.css">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lost items:</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table>
                       <thead>
                       <tr>
                       <th> Item ID</th>
                       <th> Item Name</th>
                       <th> Item Category </th>
                       <th> Item Colour </th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($items ?? '' as $item)
                       <tr>
                       <td> {{$item->id}} </td>
                       <td> {{$item->ItemName }} </td>
                       <td> {{$item->Category }} </td>
                       <td> {{$item->Colour}} </td>
                       <td align='center'><button style="width:100%;height:100%; background:transparent; background-color:transparent;border-style:hidden;">See More for lost {{$item->ItemName }} </button></td>
                       <td align='center'><button style="width:100%;height:100%; background:transparent; background-color:transparent;border-style:hidden;"><u>Fill a request form for  lost </u> {{$item->ItemName }}</button></td>
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
