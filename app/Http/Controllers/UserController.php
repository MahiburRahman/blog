<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\UserMetaInfo;
use App\Model\Post;
use App\Model\Comment;
use Illuminate\Support\Facades\Auth;
use DB;
use Hash;
class UserController extends Controller
{
    public function ViewProfile( Request $request )
    {
        $auth = Auth::user();
        $data['auth'] = $auth;
        return view('user_management.update_profile', $data);
    }

    public function SaveProfile( Request $request )
    {
        $this->validate($request, [
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users,email,'.Auth::user()->id,
        ]);

        $userObj = Auth::user();
        $userObj->email = $request->email;
        $userObj->save();

        $userMetaObj = UserMetaInfo::find(Auth::user()->id);       
        $userMetaObj->first_name = $request->first_name;
        $userMetaObj->last_name = $request->last_name;
        $userMetaObj->country_iso2_code = $request->iso2;
        $userMetaObj->country_phone_code = $request->countryCode;
        $userMetaObj->phone = $request->phone_number;
        $userMetaObj->save();

        return redirect()->route('profile_page')->with('success', 'You have updated you credentials.');
    }

    public function LogIn( Request $request )
    {
        return view('user_management.login');
    }

    public function CheckLogIn( Request $request )
    {
        $this->validate($request, [
            'email'=>'required|email',
            'password' => 'required'
        ]);

        $userObj = User::where('email', $request->email)->first();
        if(!$userObj){
            return redirect()->back()->with('unsuccess', 'Invalid email');
        }else if (! Hash::check($request->password, $userObj->password)) {
            return redirect()->back()->with('unsuccess', 'Invalid password');
        }else{
            Auth::login($userObj);
            return redirect()->route('home_page');
        }
    }

    public function SignUp( Request $request )
    {
        return view('user_management.signup');
    }

    public function SaveSignUp( Request $request )
    {
        $this->validate($request, [
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users',
            'phone_number'=>'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);


        DB::transaction(function () use ($request) {
            $genertedPassword = bcrypt($request->password);
            $dataForUsers = [
                'email' => $request->email,
                'password' => $genertedPassword,
            ];
            $userCreate = User::create($dataForUsers);

            $dataForUserDetails = [
                'id' => $userCreate->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone_number,
                'country_iso2_code' => $request->iso2,
                'country_phone_code' => $request->countryCode,
            ];
            UserMetaInfo::create($dataForUserDetails);

        });
        return redirect()->route('login_view')->with('success', 'Congratulations! You have created an account. Please login.');
    }

    public function LogOut( Request $request )
    {
        Auth::logout();
        return redirect()->route('login_view');
    }
}
