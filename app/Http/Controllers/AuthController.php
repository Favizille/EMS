<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function register(Request $request){
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'dob'=>'required',
            'address'=>'required',
            'password'=>'required',
        ]);

        $registrationDetails = [
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'email'=> $request->email,
            'dob'=> $request->dob,
            'address'=> $request->address,
            'password' => bcrypt($request->password),
        ];

        $useregistered = $this->user->create($registrationDetails);
        if(!$useregistered){
            return [
                "status" => "Failed",
                "status_code" => 400,
                "message" => "User Registration Failed"
            ];
        }

        return[
            "status" => "success",
            "status_code" => 201,
            "message" => "Successful User Registration"
        ];
    }


    public function login(Request $request){
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if(Auth::attempt($credentials)){
            $user = $this->user->where('email', $request->email)->first();
            // $token = $user->createToken('myapptoken')->plainTextToken;
            return [
                'status' => 'success',
                'status_code' => 200,
                'message' => 'User logged in successfully',
                'data' => $user,
                // 'token' => $token,
            ];
        }

        return [
            'status' => 'failed',
            'status_code' => 400,
            'message' => 'User could not login'
        ];
    }


    public function logout(){
        $loggedoutSuccessfully = Auth::logout();
        // $loggedoutSuccessfully->revoke();

        // if(!$loggedoutSuccessfully){
        //     return ['bad'];
        // }
        // return [
        //     'Good'
        // ];


        // $user = Auth::user()->logout();
        // $user->revoke();
        // return 'logged out';
    }
}
