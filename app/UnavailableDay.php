<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UnavailableDay extends Model
{
    use SoftDeletes;
    protected $table = 'unavailableday';
    public $timestamp = true;

    
    // one - one relationship between Unavailableday -> User
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
