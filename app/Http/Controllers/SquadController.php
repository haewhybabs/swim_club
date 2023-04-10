<?php

namespace App\Http\Controllers;


use App\Services\SquadDetailsService;
use App\Services\SquadService;
use App\Services\SwimmerService;
use Illuminate\Http\Request;

class SquadController extends Controller
{
    protected $squadService;
    protected $squadDetailsService;
    protected $swimmerService;
    public function __construct(SquadService $squadService, SquadDetailsService $squadDetailsService, SwimmerService $swimmerService){
        $this->squadDetailsService = $squadDetailsService;
        $this->squadService = $squadService;
        $this->swimmerService = $swimmerService;
    }
   
    //
    public function mySquad(){
        $userId = auth()->user()->id;
        $swimmer = $this->swimmerService->findByUserId($userId);
        $squadDetails = $this->squadDetailsService->findBySwimmerId($swimmer?->id);
        $mySquad = $this->squadDetailsService->findBySquadId($squadDetails?->squad_id);
        return view('user.my_squad',compact('squadDetails','mySquad'));
        
    }
    public function loadSquad(){
        
    }
}
