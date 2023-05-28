<?php

namespace App\Http\Controllers;

use App\Models\Swimmer;
use App\Services\SwimmerService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    protected $swimmerService;
    protected $userService;
    public function __construct(SwimmerService $swimmerService, UserService $userService)
    {
        $this->swimmerService = $swimmerService;
        $this->userService = $userService;
    }
    public function myParent(Request $request){
        $userId = auth()->user()->id;
        $parent = auth()->user()->role_id ==4?true:false;
        if($parent){
            $swimmer = $this->swimmerService->findByParentId($userId);
            $userId= $swimmer->user_id;
        }
        $swimmer = $this->swimmerService->findByUserId($userId);
        return view('user.my_parent',compact("swimmer"));
    }
    public function createParent(Request $request){
        $validatedData = $request->validate([
            'password' => 'required|min:8',
            'email'=>'required|email|unique:users',
            'name'=>'required',
        ]);
        $validatedData['role_id']=4;
        $validatedData['password']=bcrypt($request->password);
        $parent = $this->userService->create($validatedData);
        $swimmer = $this->swimmerService->findByUserId($request->user_id);
        $swimmerUpdate = $this->swimmerService->updateParentId($parent->id,$swimmer->id);
        if($parent){
            return redirect()->back()->with(['alert-type'=>'success','message'=>'Your parent has been successfully created. They can now access their account']);
        }

    }
    public function adminCreateParent(){
        $parents = $this->userService->findAllParents();
        $swimmers = $this->swimmerService->findSwimmersWithoutParent();
        return view('user.admin_create_parent',compact('parents','swimmers'));
    }
}
