<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //For changing the default stuffs in the table
    protected $table = 'posts';
    //primary key
    public $primaryKey = 'id';      //eg item_id
    //Timestamps
    public $timestamp = 'true';     //by default its true
}
