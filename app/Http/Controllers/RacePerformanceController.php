<?php

namespace App\Http\Controllers;

use App\Models\Distance;
use App\Models\GalaEvent;
use App\Models\RacePerformance;
use App\Models\Stroke;
use App\Services\GalaEventService;
use App\Services\RacePerformanceService;
use App\Services\SquadService;
use App\Services\SwimmerService;
use Illuminate\Http\Request;

class RacePerformanceController extends Controller
{
    protected $racePerformanceService;
    protected $swimmerService;
    protected $galaEventService;
    protected $squadService;
    public function __construct(RacePerformanceService $racePerformanceService,SwimmerService $swimmerService,GalaEventService $galaEventService, SquadService $squadService)
    {
        $this->racePerformanceService = $racePerformanceService;
        $this->swimmerService = $swimmerService;
        $this->galaEventService = $galaEventService;
        $this->squadService = $squadService;
    }
    public function viewPerformance(Request $request){

        $strokeFilter = $request->stroke_id_filter;
        $distanceFilter = $request->distance_id_filter;
        $raceTypeFilter = $request->race_type_filter;
        $galaEventFilter = $request->gala_event_filter;

        $coach = auth()->user()->role_id ==2?true:false;

        $parent = auth()->user()->role_id ==4?true:false;
        
        $isSwimmer =auth()->user()->role_id ==3?true:false;

        $query = RacePerformance::query();

        if ($strokeFilter) {
            $query->where('stroke_id', $strokeFilter);
        }

        if ($distanceFilter) {
            $query->where('distance_id', $distanceFilter);
        }

        if ($raceTypeFilter) {
            $query->where('race_type', $raceTypeFilter);
        }

        if($galaEventFilter){
            $query->where('gala_event_id',$galaEventFilter);
        }

        $swimmers = $this->swimmerService->findAll();

        if($coach){
            $coachId = auth()->user()->id;
            $coachSquad = $this->squadService->findByCoachId($coachId);

            //A coach can only access performance of just his squad;
            $query->where('squad_id',$coachSquad->id);
            //pass only swimmers that belongs to the coach squad i.e a oach can only create performance for his squad
            $swimmers = $this->swimmerService->findBySquadId($coachSquad->id);
        }

        if($parent){
            $parentId = auth()->user()->id;
            $swimmer = $this->swimmerService->findByParentId($parentId);
            //This will only fetch parent's child race performance
            $query->where('swimmer_id',$swimmer->id);
        }
        if($isSwimmer){
            $userId = auth()->user()->id;
            $swimmer = $this->swimmerService->findByUserId($userId);
            $query->where('swimmer_id',$swimmer->id);
        }
        $performances = $query->get();

        

        $strokes = Stroke::all();
        $distances = Distance::all();
        
        $galaEvents = $this->galaEventService->findAll();



        return view('race.performance',compact(
            'performances','swimmers','strokes','distances','galaEvents',
            'strokeFilter','distanceFilter','raceTypeFilter','galaEventFilter'
        ));
    }
    public function handleCreatePerformance(Request $request){
        $validatedData = $request->validate([
            'swimmer_id'=>'required',
            'race_type'=>'required',
            'stroke_id'=>'required',
            'distance_id'=>'required',
            'duration'=>'required',
        ]);

        if($request->race_type=='Event'){
            if(!$request->gala_event_id){
                return redirect()->back()->with([
                    'message'=>'Please select a gala event for an event type',
                    'alert-type'=>'success'
                ]);
            }

        }

        $galaEventId = $request->race_type=='Training'?null:$request->gala_event_id;

        $swimmer = $this->swimmerService->findById($request->swimmer_id);
        ($swimmer->squad_id);
        
        $create = $this->racePerformanceService->create([
            ...$validatedData,
            'squad_id'=>$swimmer->squad_id,
            'training_date'=>$request->training_date? date('Y-m-d H:i:s', strtotime($request->training_date)):null,
            'performance_score'=>$request->performance_score??null,
            'gala_event_id'=>$galaEventId
        ]);

        if($create){
            return redirect()->back()->with([
                'message'=>'Performace data created',
                'alert-type'=>'success'
            ]);
        }
    }
}
