<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
   use \Illuminate\Auth\Authenticatable;

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
