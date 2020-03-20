<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $table = 'users';
    public $timestamp = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','name', 'email', 'password','first_name','last_name','date_of_birth','address','phone_number','verify_code','gender','avatar','description','active','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     // one - many relationship between user -> tour
     public function tour()
     {
         return $this->hasMany('App\Tour');
     }

     public function bookedtour()
     {
         return $this->hasMany('App\BookedTour');
     }
     
     public function comment()
     {
         return $this->hasMany('App\Comment');
     }

     public function unavailableday()
     {
         return $this->hasOne('App\UnavailableDay');
     }
     
     public function rate()
     {
         return $this->hasMany('App\Rate');
     }

}
