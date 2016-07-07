<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
   public function getUsers()
   {
      $users = User::where('active',true)->where('id', '!=' , Auth::user()->id)->get();
      return view('find_friend', ['users' => $users]);
   }

   public function requestFriend()
   {
      
   }
}
