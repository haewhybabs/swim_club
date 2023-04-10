<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    protected $userRepository;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
        $user = $this->userService->findByEmail($request->email);
        if($user){
            if(Auth::attempt($login)){
                return redirect('/dashboard');
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
        $user = $this->userService->create($register);
        if($user){
            return redirect('/')->with(['alert-type'=>'success','message'=>'Registration successful']);
        }

    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
