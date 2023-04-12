<?php

namespace App\Http\Controllers;


use App\Services\SquadDetailsService;
use App\Services\SquadService;
use App\Services\SwimmerService;
use App\Services\UserService;
use Illuminate\Http\Request;

class SquadController extends Controller
{
    protected $squadService;
    protected $squadDetailsService;
    protected $swimmerService;
    protected $userService;
    public function __construct(SquadService $squadService, SquadDetailsService $squadDetailsService, SwimmerService $swimmerService,UserService $userService){
        $this->squadDetailsService = $squadDetailsService;
        $this->squadService = $squadService;
        $this->swimmerService = $swimmerService;
        $this->userService = $userService;
    }
   
    //
    public function mySquad(Request $request){
        $userId = auth()->user()->id;
        $squadId = $request->squad_id;
        $swimmer = $this->swimmerService->findByUserId($userId);
        $squadSwimmers = $this->swimmerService->findBySquadId($swimmer?->squad_id);

        $coach = $request->coach;
        if($coach){
            $coachSquad = $this->squadService->findByCoachId($userId);
            $squadId = $coachSquad->id;
        }

        if($squadId){
            $squadSwimmers = $this->swimmerService->findBySquadId($squadId);
            $swimmer = $squadSwimmers[0];
        }

        return view('user.my_squad',compact('swimmer','squadSwimmers'));
        
    }
    public function loadSquad(){
        $squads = $this->squadService->findAll();
        $coaches = $this->userService->findAllCoaches();
        return view('user.admin_create_squad',compact('squads','coaches'));
    }

    public function createSquad(Request $request){
        $validatedData = $request->validate([
            'squad_name'=>'required'
        ]);

        $squadId = $request->squad_id;
        if($request->coach_id){
            $coachSquad = $this->squadService->findByCoachId($request->coach_id);
            if($coachSquad){
                $coachSquadUpdate = $this->squadService->update([
                    'coach_id'=>null
                ],$coachSquad->id);
            }
            
        }
        

        if($squadId){
            $squad = $this->squadService->findById($squadId);
            $squadUpdate = $this->squadService->update([
                'squad_name'=>$request->squad_name,
                'coach_id'=>$request->coach_id?$request->coach_id:null
            ],$squadId);
            $message = "Squad updated successfully";
        }
        else{
            $createSquad = $this->squadService->create([
                'squad_name'=>$request->squad_name,
                'coach_id'=>$request->coach_id?$request->coach_id:null
            ]);
            $message = "Squad created successfully";
        }

        return redirect()->back()->with(['alert-type'=>'success','message'=>$message]);
    }
}
