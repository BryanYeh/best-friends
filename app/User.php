<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements Authenticatable, CanResetPasswordContract
{
   use \Illuminate\Auth\Authenticatable, CanResetPassword;

   public function posts()
   {
      return $this->hasMany('App\Post');
   }

   public function likes()
   {
      return $this->hasMany('App\Like');
   }

   public function friends()
   {
      return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')->withPivot('accepted');
   }

   public function realFriends()
   {
      return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')->wherePivot('accepted', true);
   }

   public function pendingFriends()
   {
      return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')->wherePivot('accepted', false);
   }
}
