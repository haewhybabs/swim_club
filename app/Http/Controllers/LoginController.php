<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        return view('login.index');
    }

    public function login(Request $request){
        $login = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $response = [
            'message'=>'Invalid login details',
            'alert-type'=>'error'
        ];
        $user = $this->userRepository->findByEmail($request->email);
        if($user){
            if(Auth::attempt($login)){
                return redirect('/dashboard/index');
            }
        }
        return redirect()->back()->with($response);
    }

    public function register(){

        return view('login.register');
    }
    public function handleRegister(Request $request){
        $register = $request->validate([
            'password' => 'required|min:8|confirmed',
            'email'=>'required|email|unique:users',
            'name'=>'required',
            'password'
        ]);
        $register['role_id']=3;
        $register['password']=bcrypt($request->password);
        $user = $this->userRepository->create($register);
        if($user){
            return redirect('/');
        }

    }
}
