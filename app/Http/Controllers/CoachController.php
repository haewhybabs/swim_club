<?php

namespace App\Http\Controllers;

use App\Services\SwimmerService;
use App\Services\UserService;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    protected $swimmerService;
    protected $userService;
    public function __construct(SwimmerService $swimmerService, UserService $userService)
    {
        $this->swimmerService = $swimmerService;
        $this->userService = $userService;
    }
    public function loadCoaches(){
        $coaches = $this->userService->findAllCoaches();
        return view('user.admin_create_coach',compact('coaches'));
    }

    public function createCoach(Request $request){
        $validatedData = $request->validate([
            'password' => 'required|min:8',
            'email'=>'required|email|unique:users',
            'name'=>'required',
        ]);
        $validatedData['role_id']=2;
        $validatedData['password']=bcrypt($request->password);
        $coach = $this->userService->create($validatedData);
        if($coach){
            return redirect()->back()->with(['alert-type'=>'success','message'=>'A new coach has been successfully created. The account can now be accessed']);
        }
    }
    //
}
