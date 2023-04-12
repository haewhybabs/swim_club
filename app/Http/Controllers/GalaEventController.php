<?php

namespace App\Http\Controllers;

use App\Models\Distance;
use App\Models\Stroke;
use App\Services\GalaEventService;
use Illuminate\Http\Request;

class GalaEventController extends Controller
{
    protected $galaEventService;

    public function __construct(GalaEventService $galaEventService)
    {
        $this->galaEventService = $galaEventService;
    }
    public function viewEvent(){
        $galaEvents = $this->galaEventService->findAll();
        $strokes = Stroke::all();
        $distances = Distance::all();

        
        return view('race.gala_event',compact('galaEvents','strokes','distances'));
    }
    public function createEvent(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required',
            'distance_id'=>'required',
            'stroke_id'=>'required',
            'gender'=>'required',
            'gala_date'=>'required',
            'race_type'=>'required'
        ]);

        $validatedData['gala_date']= date('Y-m-d H:i:s', strtotime($request->gala_date));

        $create = $this->galaEventService->create($validatedData);

        if($create){
            return redirect()->back()->with([
                'Race Event created'
            ]);
        }
    }
}
