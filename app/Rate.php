<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Rate extends Model
{
    use SoftDeletes;
    protected $table = 'rate';
    public $timestamp = true;
    protected $fillable = [
        'customer_id','tour_id','rate','comment','is_deleted','status'
    ];
    // one - many relationship between rate -> User
    public function user()
    {
        return $this->belongsTo('App\User','customer_id');
    }
    // one - many relationship between rate -> tour
    public function tour()
    {
        return $this->belongsTo('App\Tour');
    }
}
