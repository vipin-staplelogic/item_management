<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{   

    protected $table = 'items';
    protected $fillable = [ 'title' , 'item_position' , 'created_at','updated_at' ];


}
