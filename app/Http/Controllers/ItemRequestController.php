<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemRequest;
use App\Item;
use App\User;
class ItemRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // just like in ItemController, we take all requests and send them to the screen for the table generation via blade
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
      //get the item requested and send it to the createrequest screen
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
      //getting the input from the form and saving it into the item
      $itemRequest = new ItemRequest;
      $itemRequest->itemid = $request->input('itemid');
      $itemRequest->userid = $request->input('userid');
      $itemRequest->Reason = $request->input('reason');
      $itemRequest->created_at = now();
      $itemRequest->updated_at = now();
      //getting all requests
      $allrequests=ItemRequest::all();
      //checking if the requests already exists
      $allitems = $allrequests->where('itemid', $itemRequest->itemid); //get all requests with our item id
    foreach ($allitems as $requestedItem) {
      if($requestedItem->userid==$itemRequest->userid){
        return back()->withErrors(['You already requested this item!']); //if the item id and user id matches with the data
      }                                                                   //that we already retrieved, display an error message
    }
    //if no requests matches our user and item id, store the new request
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
        //we didnt need that
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //gets the request to be reviewed and sends it to the screen for review
      $request = ItemRequest::find($id);
    return view('itemrequests.reviewrequest',['request'=>$request]);

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
      //since we are only reviewing the request, we retrieve the request and edit the status based on the admin input
        $itemreq=ItemRequest::find($id);
        $itemreq->Status = $request->input('status');
        $itemreq->save();

        return back()->with('success', 'Request status has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //deletes the record of that request
      $req = ItemRequest::find($id);
      $req->delete();
      return back()->with('success','Request has been deleted');
    }
}
