<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
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
      //sends all items to the first screen where they are displayed in a table via blade
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
      //just refers to the create screen, the screen later calls store()
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
'FoundBy' => 'required',
'Pictures[]' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
]);
//Handles the uploading of the image
$allImageNames='noimage.jpg'; //setting the images to nothing if nothing is sent(prevents nullPointer)
if ($request->hasFile('Picture')){
  $allImageNames=''; //wipes out the 'no images.jpg' as we need to store things now
  foreach($request->file('Picture') as $image){ //we are getting each image sent from the user 1 by 1 and loop
//validation of the image. making sure that the file is an image
if(exif_imagetype($image)){
}else{
  $errors='Please, make sure all files are images!';
  return back()->withErrors(['Make sure all files are images!(eg. jpg,png)']); //letting the user know that he sent us a wrong file format
}
//Gets the filename with the extension
$fileNameWithExt = $image->getClientOriginalName();
//just gets the filename
$filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
//Just gets the extension
$extension = $image->getClientOriginalExtension();
//Gets the filename to store
$fileNameToStore = $filename.'_'.time().'.'.$extension;
//if there isnt anything in $allImageNames store the first image in
if ($allImageNames=='') {
  $allImageNames=$fileNameToStore;
}else {
$allImageNames=$allImageNames.','.$fileNameToStore; //then append all following images with a comma (we need to be able to split them later)
}
//Uploads the image
$path =$image->storeAs('public/images', $fileNameToStore);
}
}
else {
$fileNameToStore = 'noimage.jpg';
}
// create a Item object and set its values from the input
$item = new Item;
$item->ItemName = $request->input('ItemName');
$item->Category = $request->input('Category');
$item->Colour = $request->input('Colour');
$item->Date = $request->input('Date');
$item->Location = $request->input('Location');
$item->Description = $request->input('Description');
$item->FoundBy = $request->input('FoundBy');
$item->created_at = now();
$item->updated_at = now();
$item->Pictures = $allImageNames;
// save the Item object
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
        //get the item by id
        $item = Item::find($id);
        //get the pictures string from the database
        $str=$item->Pictures;
        //split the string into an array of strings on each comma (we split the images earlier with commas)
        $manyurls=explode(",",$str);
        //return the view by passing the array of images, which we will use to display each image using blade
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
      //just getting the screen for editing
      $item = Item::find($id);
return view('items.edit',compact('item'));
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
      $item=Item::find($id);
      $this->validate(request(), [
      'ItemName' => 'required',
      'Category' => 'required',
      'Colour' => 'required',
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
      if(exif_imagetype($image)){
      }else{
        $errors='Please, make sure all files are images!';
        return back()->withErrors(['Make sure all files are images!']);
      }
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
      //storing the updated details
      $item->ItemName = $request->input('ItemName');
      $item->Category = $request->input('Category');
      $item->Colour = $request->input('Colour');
      //ensuring that updating with a null value doesnt throw an error
      if ($request->input('Date')==null) {
        // code...
      }else {
      $item->Date = $request->input('Date');
      }
      $item->Location = $request->input('Location');
      $item->Description = $request->input('Description');
      $item->updated_at = now(); //setting that the item has been updated now
      //if no images are submitted, it doesnt wipe the images already there, only does it if new images are provided
      if ($allImageNames=='noimage.jpg') {

      }else {
        $item->Pictures = $allImageNames;
      }

      // save the Item object
      $item->save();
      // generate a redirect HTTP response with a success message
      return back()->with('success', 'Item has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //deletes the item, which updates the database automatically
      $item = Item::find($id);
      $item->delete();
      return redirect('items')->with('success','Item has been deleted');
    }
}
