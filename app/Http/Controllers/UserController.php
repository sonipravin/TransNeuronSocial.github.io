<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class UserController extends Controller
{
    public function index(Request $request){

    	if($request['search'])
    	{
    		$user = User::where('name','like','%'.$request['search'].'%')->get();
    	}else{
    		$user = User::find(Auth::user()->id);
    		$user = $user->whereHas('follower',function($q) {
    			$q->where('follower_id','!=',Auth::user()->id);
		    		})
		    	->orwhereHas('following',function($q) {
		    			$q->where('following_id','!=',Auth::user()->id);
		    		})->get();

    	}
    	return view('index',compact('user'));		
    }

    public function friendlist(Request $request){

    	$user = User::find(Auth::user()->id);

    	$user = $user->whereHas('follower',function($q) {
    			$q->where('follower_id',Auth::user()->id);
    			$q->where('status',2);
		    		})
		    	->orwhereHas('following',function($q) {
		    			$q->where('following_id',Auth::user()->id);
		    			$q->where('status',2);
		    		})->get();
    	
    	return view('friends',compact('user'));		
    }

    public function friendRequestList(Request $request){

    	$user = User::find(Auth::user()->id);

    	$pendingRequest = $user->whereHas('following',function($q) {
    			$q->where('following_id',Auth::user()->id);
    			$q->where('status',1);
    		})->get();

    	return view('pendingrequest',compact('pendingRequest'));		
    }

    public function acceptfriendRequestList($id){

    	$user = User::find(Auth::user()->id);
    	
    	$data['status'] = 2;
    	$acceptRequest = $user->whereHas('follower',function($q) use($id){
    			$q->where('follower_id',$id);
    		})->update($data);
    	dd($acceptRequest);
    	return view('pendingrequest',compact('pendingRequest'));		
    }

    public function otherprofile(Request $request,$id){

    	
    	$Otheruser = User::whereId($id)->first();

    	$OtherSfriend = $Otheruser->whereHas('follower',function($q) use($id){
				$q->where('follower_id',$id);
				$q->where('status',2);
		    		})
		    	->orwhereHas('following',function($q) use($id) {
		    			$q->where('following_id',$id);
		    			$q->where('status',2);
		    		})->get();

		$mySelf = User::whereId(Auth::user()->id)->first();

		$myFriend = $mySelf->whereHas('follower',function($q){
				$q->where('follower_id',Auth::user()->id);
				$q->where('status',2);
		    		})
		    	->orwhereHas('following',function($q) {
		    			$q->where('following_id',Auth::user()->id);
		    			$q->where('status',2);
		    		})->pluck('id');
    	if(count($myFriend)){$myFriend = $myFriend->toArray();}

    		return view('othersProfile',[
    							'OtherSfriend'=>$OtherSfriend,
    							'myFriend'=>$myFriend,
    							'Otheruser'=>$Otheruser
    						]);
    }
}
