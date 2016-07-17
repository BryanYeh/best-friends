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


   /**
    * Friend Request
    * @param Request $request
    * @return \Illuminate\Http\RedirectResponse
    */
   public function request(Request $request)
   {
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
              ['user_id' => Auth::user()->id,
                  'friend_id' => $user->id,
                  'accepted' => false,
                  'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                  'updated_at' => DB::raw('CURRENT_TIMESTAMP')]
          );
   }


   /**
    * Cancel Friend Request
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    */
   public function cancel(Request $request)
   {
      $this->validate($request,[
         'email' => 'required|email'
      ]);

      $email = $request['email'];

      $user = User::where('email',$email)->where('active',true)->first();
      if($user) {
         $check = DB::table('friends')
             ->where('user_id', Auth::user()->id)
             ->where('friend_id', $user->id)
             ->first();

         if ($check) {
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

   /**
    * Accept Request
    * @param Request $request
    * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
    */
   public function accept(Request $request)
   {
      $this->validate($request, [
          'email' => 'required|email'
      ]);

      $email = $request['email'];

      $users = User::where('active', true)->where('email', $email)->first();

      if ($users) {
         $update = DB::table('friends')
             ->where('user_id', $users->id)
             ->where('friend_id', Auth::user()->id)
             ->update(['accepted' => true, 'updated_at' => DB::raw('CURRENT_TIMESTAMP')]);

         if ($update) {
            DB::table('friends')
                ->insert(
                    ['user_id' => Auth::user()->id,
                        'friend_id' => $users->id,
                        'accepted' => true,
                        'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                        'updated_at' => DB::raw('CURRENT_TIMESTAMP')]
                );
            return response("", 200);
         } else {
            return response("", 400);
         }
      } else {
         return response("", 400);
      }
   }

   /**
    * Decline Friend Request
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    */
   public function decline(Request $request)
   {
      $this->validate($request, [
          'email' => 'required|email'
      ]);

      $email = $request['email'];

      $user = User::where('email', $email)->where('active', true)->first();
      if ($user) {
         $check = DB::table('friends')
             ->where('user_id', $user->id)
             ->where('friend_id', Auth::user()->id)
             ->first();

         if ($check) {
            DB::table('friends')
                ->where('user_id', $user->id)
                ->where('friend_id', Auth::user()->id)->delete();
            return response()->json(['message' => 'Declined Request'], 200);
         } else
            return response()->json(['message' => 'No such request'], 400);
      } else
         return response()->json(['message' => 'User doesn\'t exist'], 400);
   }

   public function unfriend(Request $request)
   {
      $this->validate($request, [
          'email' => 'required|email'
      ]);

      $email = $request['email'];

      $user = User::where('email', $email)->where('active', true)->first();
      if ($user) {
         $check1 = DB::table('friends')
             ->where('user_id', $user->id)
             ->where('friend_id', Auth::user()->id)
             ->first();
         $check2 = DB::table('friends')
             ->where('user_id', Auth::user()->id)
             ->where('friend_id', $user->id)
             ->first();

         if ($check1 && $check2) {
            DB::table('friends')
                ->where('user_id', $user->id)
                ->where('friend_id', Auth::user()->id)->delete();
            DB::table('friends')
                ->where('user_id', Auth::user()->id)
                ->where('friend_id', $user->id)->delete();
            return response()->json(['message' => 'Unfriended'], 200);
         } else
            return response()->json(['message' => 'No friend'], 400);
      } else
         return response()->json(['message' => 'Unable to unfriend'], 400);
   }
}
