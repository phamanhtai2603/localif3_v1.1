<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BookedTour extends Model
{
    use SoftDeletes;
    protected $table = 'bookedtour';
    public $timestamp = true;

    // one - many relationship BookedTour -> User
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // one - many relationship BookedTour -> Tour
    public function tour()
    {
        return $this->belongsTo('App\tour');
    }
}
