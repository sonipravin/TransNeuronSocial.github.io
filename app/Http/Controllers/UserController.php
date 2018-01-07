<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use Session;

class UserController extends Controller
{
    
    // Home page
        public function index(Request $request)
        {
        	$friend = User::find(Auth::user()->id);

    		$friend = $friend->whereHas('follower',function($q) {
    			$q->where('follower_id',Auth::user()->id);
    	    		})
    	    	->orwhereHas('following',function($q) {
    	    			$q->where('following_id',Auth::user()->id);
    	    		})->pluck('id');

        	if($request['search'])
        	{
        		$user = User::where('name','like','%'.$request['search'].'%')->where('id','!=',Auth::user()->id)->whereNotIn('id',$friend)->get();

        		if(count($user))
        		{
        			$message = NULL;
        		}else{
        			$message = 'No Record found. please try something else !';
        		}
        		
        	}else{
        		$user = NULL;		
        		$message = NULL;    
        	}

        	return view('index',compact('user','message'));		
        }

    // Add to friend

    public function addfriend($id)
    {

    	$user = User::find(Auth::user()->id);
    	$user->following()->attach($id,['status'=>1]);    	
    	\Session::flash('success','Connection added');
    	return \Redirect('home');
    }

    // Friend Listing

    public function friendlist()
    {
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

    // Friend Request List

    public function friendRequestList()
    {

    	$user = User::find(Auth::user()->id);

    	$pendingRequest = $user->whereHas('following',function($q) {
    			$q->where('following_id',Auth::user()->id);
    			$q->where('status',1);
    		})->get();

    	return view('pendingrequest',compact('pendingRequest'));		
    }

    // Accepting friend request

    public function acceptfriendRequestList($id)
    {

    	$user = User::find(Auth::user()->id);
    	$user->follower()->updateExistingPivot($id,['status'=>2]);    	

    	return \Redirect('request');	
    }

    // Friends Profile

    public function otherprofile(Request $request,$id)
    {
    	// Friends of friend starts here
        	$Otheruser = User::whereId($id)->first();
        	$OtherSfriend = $Otheruser->whereHas('follower',function($q) use($id){
    				$q->where('follower_id',$id);
    				$q->where('status',2);
    		    		})
    		    	->orwhereHas('following',function($q) use($id) {
    		    			$q->where('following_id',$id);
    		    			$q->where('status',2);
    		    		})->get();
        // Friends of friend ends here

        // my friends starts here
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
        // my friends starts here

		return view('othersProfile',[
							'OtherSfriend'=>$OtherSfriend,
							'myFriend'=>$myFriend,
							'Otheruser'=>$Otheruser
						]);
    }
}
