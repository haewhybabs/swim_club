<?php

namespace App\Http\Controllers;

use App\Services\GalaEventService;
use App\Services\RacePerformanceService;
use App\Services\SquadService;
use App\Services\SwimmerService;
use App\Services\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
        protected $swimmerService;
        protected $galaEventService;
        protected $squadService;
        protected $userService;
        public function __construct(SwimmerService $swimmerService,GalaEventService $galaEventService, SquadService $squadService, UserService $userService)
        {
            $this->swimmerService = $swimmerService;
            $this->galaEventService = $galaEventService;
            $this->squadService = $squadService;
            $this->userService = $userService;
            
        }
    public function index(Request $request){
        $swimmers = count($this->swimmerService->findAll());
        $galas = count($this->galaEventService->findAll());
        $squads = count($this->squadService->findAll());
        $parents = count($this->userService->findAllParents());
        return view('dashboard.index',compact('swimmers','galas','squads','parents'));
    }
}
