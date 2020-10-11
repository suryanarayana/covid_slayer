<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
     //Table name
     protected $table    =   'games';
     //Primary key
     public $primaryKey  =   'game_id';
     //Timestamps
     public $timestamps  =   false;

     
}
