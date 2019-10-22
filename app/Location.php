<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Location extends Model
{
    use SoftDeletes;
    protected $table = 'location';
    public $timestamp = true;

     // one - many relationship between location -> tour
     public function tour()
     {
         return $this->hasMany('App\Tour');
     }
}
