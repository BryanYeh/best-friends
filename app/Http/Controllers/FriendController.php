<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

   public function request(Request $request)
   {
      //TODO:: finish friend request
      $this->validate($request, [
         'email' => 'required|email'
      ]);

      $email = $request['email'];

      $user = User::where('email',$email)->where('active',true)->first();

      if (!$user || Auth::user()->email == $email) {
         return redirect()->back();
      }

      DB::table('friends')
          ->insert(
              ['user_id' => Auth::user()->id, 'friend_id' => $user->id, 'accepted' => false]
          );
   }

   public function cancel(Request $request)
   {
      $this->validate($request,[
         'email' => 'required|email'
      ]);

      $email = $request['email'];

      $user = User::where('email',$email)->where('active',true)->first();
      if($user) {
         $test1 = DB::table('friends')
             ->where('user_id', $user->id)
             ->where('friend_id', Auth::user()->id)
             ->first();
         $test2 = DB::table('friends')
             ->where('user_id', Auth::user()->id)
             ->where('friend_id', $user->id)
             ->first();

         if ($test1) {
            DB::table('friends')
                ->where('user_id', $user->id)
                ->where('friend_id', Auth::user()->id)
                ->delete();
            return response()->json(['message' => 'Canceled Request'], 200);
         } elseif ($test2) {
            DB::table('friends')
                ->where('user_id', Auth::user()->id)
                ->where('friend_id', $user->id)->delete();
            return response()->json(['message' => 'Canceled Request'], 200);
         } else
            return response()->json(['message' => 'No such request'], 400);
      }
      else
         return response()->json(['message' => 'User doesn\'t exist'], 400);
   }
}
