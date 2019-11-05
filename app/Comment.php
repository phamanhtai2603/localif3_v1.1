<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Comment extends Model
{
    use SoftDeletes;
    protected $table = 'comment';
    public $timestamp = true;

    // one - many relationship between rate -> User
    public function user()
    {
        return $this->belongsTo('App\User','customer_id');
    }
    // one - many relationship between rate -> tour
    public function tour()
    {
        return $this->belongsTo('App\Tour','tour_id');
    }
}
