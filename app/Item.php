<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = ['ItemName','Category', 'Colour','Date','Location','Description'];
}
