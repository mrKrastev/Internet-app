<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $items = Item::all()->toArray();
return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

// form validation
$item = $this->validate(request(), [
'ItemName' => 'required',
'Category' => 'required',
'Colour' => 'required',
'Date' => 'required',
'Location' => 'required',
'Description' => 'required',
'Pictures[]' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
]);
//Handles the uploading of the image
$allImageNames='noimage.jpg';
if ($request->hasFile('Picture')){
  $allImageNames='';
  foreach($request->file('Picture') as $image){
//Gets the filename with the extension
$fileNameWithExt = $image->getClientOriginalName();
//just gets the filename
$filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
//Just gets the extension
$extension = $image->getClientOriginalExtension();
//Gets the filename to store
$fileNameToStore = $filename.'_'.time().'.'.$extension;
if ($allImageNames=='') {
  $allImageNames=$fileNameToStore;
}else {
$allImageNames=$allImageNames.','.$fileNameToStore;
}
//Uploads the image
$path =$image->storeAs('public/images', $fileNameToStore);
}
}
else {
$fileNameToStore = 'noimage.jpg';
}
// create a Vehicle object and set its values from the input
$item = new Item;
$item->ItemName = $request->input('ItemName');
$item->Category = $request->input('Category');
$item->Colour = $request->input('Colour');
$item->Date = $request->input('Date');
$item->Location = $request->input('Location');
$item->Description = $request->input('Description');
$item->created_at = now();
$item->updated_at = now();
$item->Pictures = $allImageNames;
// save the Vehicle object
$item->save();
// generate a redirect HTTP response with a success message
return back()->with('success', 'Item has been added');
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
        $item = Item::find($id);
        $str=$item->Pictures;
        $manyurls=explode(",",$str);
return view('items.show',compact('item'),['manyurls'=>$manyurls]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
