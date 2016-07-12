<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
   protected function addToList($list,$email,$first_name,$last_name,$status)
   {
      if ($email != Auth::user()->email){
         if (!key_exists($email, $list)) {
            $list[$email] = array('first_name' => $first_name,
                'last_name' => $last_name,
                'status' => $status);
         } else {
            if ($list[$email]['status'] == "request") {
               $list[$email] = array('first_name' => $first_name,
                   'last_name' => $last_name,
                   'status' => $status);
            }
         }
      }
      return $list;
   }

   public function getUsers()
   {
      $usersList = array();
      $users = User::where('active',true)->get();
      $userList = array();

      foreach ($users as $user) {
         if(!$user->friends->isEmpty()){
            foreach($user->friends as $friend){
               if($friend->pivot->accepted) {
                  if ($user->email == Auth::user()->email)
                     $userList = $this->addToList($userList, $friend->email, $friend->first_name, $friend->last_name, 'already');
               }
               elseif (!$friend->pivot->accepted && $user->email == Auth::user()->email)
                  $userList =  $this->addToList($userList,$friend->email,$friend->first_name,$friend->last_name,'pending');
               elseif(!$friend->pivot->accepted && $friend->email == Auth::user()->email)
                  $userList =  $this->addToList($userList,$user->email,$user->first_name,$user->last_name,'accept');
               else
                  $userList =  $this->addToList($userList,$friend->email,$friend->first_name,$friend->last_name,'request');
            }
         }
         $userList = $this->addToList($userList, $user->email, $user->first_name, $user->last_name, 'request');
      }

      return view('find_friend' , ['users' => $userList]);
   }

   public function requestFriend(Request $request)
   {
      $this->validate($request, [
         'email' => 'required|email'
      ]);

      $email = $request['email'];

      $user = User::where('email',$email)->where('active',true)->first();

      if(!$user){
         return redirect()->back()->with(['meesage'=>'User not found']);
      }

      if(Auth::user()->email == $email){
         return redirect()->back()->with(['meesage'=>'Stop trying to friend yourself']);
      }
   }
}
