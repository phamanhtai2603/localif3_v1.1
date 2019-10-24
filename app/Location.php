<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Location extends Model
{
    use SoftDeletes;
    protected $table = 'location';
    public $timestamp = true;

    protected $fillable = [
        'name', 'description','sign','image','status',
    ];
     // one - many relationship between location -> tour
     public function tour()
     {
         return $this->hasMany('App\Tour');
     }


}
