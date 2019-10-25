<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tour extends Model
{
    use SoftDeletes;
    protected $table = 'tour';
    public $timestamp = true;

    protected $fillable = [
        'tourguide_id','name', 'location_id', 'description','content','plan','image','price','status',
    ];

     // one - many relationship Tour -> User
     public function user()
     {
         return $this->belongsTo('App\User','tourguide_id');
     }

     // one - one relationship between tour -> location
    public function location(){
        return $this->belongsTo('App\Location','location_id');
    }
   
    // one - many relationship between tour -> bookedtour
    public function bookedtour()
    {
        return $this->hasMany('App\BookedTour');
    }

     // one - many relationship between tour -> comment
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    // one - many relationship between tour -> rate
    public function rate(){
        return $this->hasMany('App\Rate');
    }
}
