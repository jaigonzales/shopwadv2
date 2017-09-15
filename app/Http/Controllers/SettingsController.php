<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class SettingsController extends Controller
{
    /*
     * Display Account Settings
     */
    public function index(){

        $user = User::find(Auth::user()->id);
        $user->get();

        return view('profile.settings')->with('user_info', $user);
    }

    /*
     * Account Settings
     */
    public function updateFname( Request $request ){
        $user = User::find(Auth::user()->id);
        $user->firstname = $request->input('fname');
        $user->save();

        if (!$user){
            return response()->json(['resp' => 1], 200);
        }

        return response()->json(['resp' => 0], 200);
    }

    public function updateLname( Request $request ){
        $user = User::find(Auth::user()->id);
        $user->lastname = $request->input('lname');
        $user->save();

        if (!$user){
            return response()->json(['resp' => 1], 200);
        }

        return response()->json(['resp' => 0], 200);

    }

    public function updateBday( Request $request ){
        $user = User::find(Auth::id());
        $user->birthday = $request->input('birthday');
        $user->save();

        if (!$user){
            return response()->json(['resp' => 1], 200);
        }

        return response()->json(['resp' => 0], 200);
    }

    public function updateEmail( Request $request ) {

        $input = $request->all();

        if ( Auth::check() ){
            $user = User::find(Auth::id());

            $email = User::where('email', '=', $input['email'])->first();

            if ( $email === null ){
                $user->email = $input['email'];
                $user->save();
                return response()->json(['res' => 1], 200);
            }else{
                return response()->json(['res' => 0], 205);
            }
        }

    }

    public function updatePassword( Request $request ) {

        $input = $request->all();

        if ( Auth::check() ){

            $user = User::find(Auth::id());

            if(!Hash::check($input['existing_password'], $user->password)){
                return response()->json(['res' => 0], 204);
            }else{
                $user->fill([
                    'password' => Hash::make($input['new_password'])
                ])->save();
                return response()->json(['res' => 1], 200);
            }
        }
    }

    public function confirmDeletion( Request $request ) {

        $input = $request->all();

        if ( Auth::check() ) {
            $user = User::find(Auth::id());

            if (Hash::check($input['confirmed_password'], $user->password)){
                try {

                    $user->delete();
                    return response()->json(['res' => 100], 200);

                }catch(\Exception $e){ }

            }else{

                // password not matched
                return response()->json(['res' => 200], 201);
            }
        }
    }

    public function avatar(){
        return view('profile.avatar');
    }

    public function updateAvatar( Request $request  ){

        try {
            \Cloudder::upload($request->file('new_avatar'), 'swuser_' . Auth::id() . 'jlj143', array(
                'width' => '290',
                'height' => '290',
                'crop' => 'fill',
                'gravity' => 'face',
                'format' => 'jpg',
                'invalidate' => true
            ));

//            $avatarUrl = 'http://res.cloudinary.com/' . env('CLOUDINARY_CLOUD_NAME') . '/image/upload/' . 'swuser_' . Auth::id() . 'jlj143.jpg';
            $url = \Cloudder::getResult();

            $avatarUrl = $url['url'];

            $user = User::find(Auth::id());
            $user->avatar = $avatarUrl;
            $user->save();


        }catch(\Exception $e){
            $e->getMessage();
        }

        return redirect('/avatar');
    }

    /*
     * Blocked Users
     */
    public function getBlocklist() {
        $user = User::find(Auth::id());

        $blocklist = $user->getBlockedFriendships();

        return view('profile.blocklist')->with('blocklist', $blocklist);
    }
}
