<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{


    public function postSignUp(Request $request){
        $this->validate($request,[
            'email' => 'required|email|unique:users',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'Contact_No' => 'required|min:10|unique:users',
            'password' => 'required|min:5'
        ]);
        $email = $request['email'];
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $contact = $request['Contact_No'];
        $password = bcrypt($request['password']);
    
        $user = new User();
        $user->email=$email;
        $user->first_name=$first_name;
        $user->last_name=$last_name;
        $user->Contact_No=$contact;
        $user->password=$password;
        $user->save();
        
        Auth::login($user);

        return redirect()->route('dashboard');
    }


    public function postSignIn(Request $request){

        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::Attempt(['email' => $request['email'],'password' => $request['password']])){

            return redirect()->route('dashboard');

        }
        else {
            $pm = "Please Enter the correct credentials";
            redirect()->route('home')->with(['pm' => $pm]);
        }

    }

    public function account(){
        return view('account',['$user' => Auth::user()]);
    }

    public function saveaccount(Request $request){
        $this->validate($request,[
            'email' => 'required|email|unique:users',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'Contact_No' => 'required|min:10|unique:users|integer'    
        ]);
        $user = Auth::user();
        $user->First_Name = $request['First_Name'];
        $user->Last_Name = $request['Last_Name'];
        $user->email = $request['email'];
        $user->Contact_No = $request['Contact_No'];
        $user->save();
       /* $file = $request->file('image');
        $filename = $request['First_Name'].'-'.$user->id.'.jpg';
        if($file){
            Storage::disk('local')->put('$filename',File::get($file));
        }*/
        return redirect()->route('account')->with(['message' => 'Account Updated Succesfully']);
    }

    public function fileUpload(Request $request)

    {

    $this->validate($request, [

        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    ]);


    $image = $request->file('image');

    $input['imagename'] = Auth::user()->First_Name.'.'.$image->getClientOriginalExtension();

    $destinationPath = local('');

    $image->move($destinationPath, $input['imagename']);


    //$this->postImage->add($input);


    return back()->with(['message' => 'Image Upload successful']);

    }

    public function getImage(){
        $file = Storage::disk('public')->get(Auth::user()->First_Name.'-'.Auth::user()->id.'.jpg');
        return new Response($file);
    }
 
    public function getPostImage($dp){
        $file = Storage::disk('public')->get($dp);
        ?> <script>window.alert($dp);</script><?php
        return new Response($file);
    }

    public function getAccount()
    {
        return view('account', ['user' => Auth::user()]);
    }
    public function postSaveAccount(Request $request)
    {
        $this->validate($request, [
           'first_name' => 'required|max:120',
           'last_name' => 'required|max:120',
           'contact_no' => 'required|max:10|min:10',
           'email' => 'required|email',
           'image' => 'required'
        ]);
        $user = Auth::user();
        $old_name = $user->first_name;
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->contact_no = $request['contact_no'];
        $user->email = $request['email'];
        $user->update();
        $file = $request->file('image');
        $filename = Auth::user()->First_Name . '-' . Auth::user()->id . '.jpg';
        $old_filename = $old_name . '-' . $user->id . '.jpg';
        $user->pic = $filename;
        $user->update();
        Storage::disk('public')->put($filename, File::get($file));
        return redirect()->route('dashboard')->with(['message' => 'Account Updated Succesfully']);
    }
    
    public function getUserImage($filename)
    {
        $file = Storage::disk('public')->get($filename);
        return new Response($file, 200);
    }

    public function Logout(){
        Auth::logout();
        return redirect()->route('welcome');
    }

    
}
