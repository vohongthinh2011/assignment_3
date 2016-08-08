<?php

class FriendsController extends \BaseController {

	public function showFriendsList(){
        
        $user = Auth::user();
        
        $friends = Friend::where('UID', '=', $user->id)->get();
        
        
        return View::make('friends', [
            'user' => $user,
            'friends' => $friends 
        ]);
    }
    
    public function addFriend(){
        
        $validation = Validator::make(Input::all(),[
            'email' => 'required',
        ]);
        
        if($validation->fails()){
            $messages = $validation->messages();
            Session::flash('validation_messages', $messages);
            return Redirect::back()->withInput();
        }
        
        
        $user = Auth::user();
        $email = Input::get('email');
        
        //retrieve user-friend info
        $count = User::where('email', '=', $email)->count();
        if($count < 1){
            Session::flash('error_message', 'Invalid email, try again');
            return Redirect::back()->withInput();
        } 
        
        $friend_query = User::where('email', '=', $email)->first();
        
        
        try{
            $friend = Friend::create([
                'UID' => $user->id,
                'name' => $friend_query->full_name,
                'email' => Input::get('email'),
            ]);
            
            $user->num_of_friends += 1;
            $user->save();
        }catch(Exception $e){
            Session::flash('error_message', 'Oops! something is wrong');
            return Redirect::back()->withInput();
        }
        
       
        return Redirect::to('/friends');
    }


}
