<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemRequest;
use App\Item;
class ItemRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $itemrequests = ItemRequest::all()->toArray();
return view('itemrequests.index', compact('itemrequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item=Item::find($id);
        return view('itemrequests.createrequest',['item'=>$item]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $itemRequest = new ItemRequest;
      $itemRequest->itemid = $request->input('itemid');
      $itemRequest->userid = $request->input('userid');
      $itemRequest->Reason = $request->input('reason');
      $itemRequest->created_at = now();
      $itemRequest->updated_at = now();
      $allrequests=ItemRequest::all();
      $allitems = $allrequests->where('itemid', $itemRequest->itemid);
    foreach ($allitems as $requestedItem) {
      if($requestedItem->userid==$itemRequest->userid){
        return back()->withErrors(['You already requested this item!']);
      }
    }
      $itemRequest->save();
      // generate a redirect HTTP response with a success message
      return back()->with('success', 'Request has been submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $req = ItemRequest::find($id);
      $req->delete();
      return back()->with('success','Request has been deleted');
    }
}
