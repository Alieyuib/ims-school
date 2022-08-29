<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\Request;
use App\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Authentication extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function saveUser(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'fname' => 'required|max:50',
            'email' => 'required|max:100|unique:users',
            'password' => 'required|min:6|max:50',
            'cpassword' => 'required|min:6|same:password'
        ],[
            'cpassword.same' =>'Password did not matched',
            'cpassword.required' => 'Confirm password is required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'msg' => $validator->getMessageBag(),
            ]);
        } else {
            $user_data = new User();
            $user_data->name = $request->fname;
            $user_data->email = $request->email;
            $user_data->password = Hash::make($request->password);
            $user_data->save();
            return response()->json([
                'status' => 200,
                'msg' => 'Registered Succssfully'
            ]);
        }
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'msg'   => $validator->getMessageBag()
            ]);
        }else{
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    Auth::login($user);  
                   $request->session()->put('loggedInUser', $user->id);
                   $request->session()->put('loggedInName', $user->name);
                   $request->session()->put('loggedInEmail', $user->email);
                   $request->session()->put('loggedInCreatedAt', $user->created_at);
                   $userLoggedIn = $request->session()->get('loggedInName');
                   return response()->json([
                       'status' => 200,
                       'msg'    => 'success',
                       'msg2'   => 'LoggedIN As'.' '.$userLoggedIn,
                   ]);
                }else{
                    return response()->json([
                        'status' => 401,
                        'msg'    => 'Email or password is incorrect',
                        'icon' =>   'warning'
                    ]);
                }
            }else{
                return response()->json([
                    'status'  => 401,
                    'msg' => 'User not found!',
                    'icon' =>   'warning'
                ]);
            }
        }
    }

    public function profile(Request $request)
    {
        $view_data['loggedInData'] = $request->session()->all();
        return $view_data['loggedInData'];
    }

    public function assignUserRole(Request $request)
    {
        return $request;
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
