<?php

namespace App\Http\Controllers;

use App\Services\PersonalInfoService;
use App\Services\SquadService;
use App\Services\SwimmerService;
use DateTime;
use Illuminate\Http\Request;

class PersonalInfoController extends Controller
{
    protected $personalInfoService;
    protected $swimmerService;
    protected $squadService;
    public function __construct(PersonalInfoService $personalInfoService, SwimmerService $swimmerService,SquadService $squadService)
    {
        $this->personalInfoService = $personalInfoService;
        $this->swimmerService = $swimmerService;
        $this->squadService = $squadService;
    }
    public function loadInfo(){
        $userId = auth()->user()->id;
        $personalInfo = $this->personalInfoService->findByUserId($userId);
        $swimmer = $this->swimmerService->findByUserId($userId);
        $squads = $this->squadService->findAll();
        return view('user.personal_info',compact('personalInfo','swimmer','squads'));
    }
    public function saveUserInfo(Request $request){
        $userId = auth()->user()->id;
        $validatedData = $request->validate([
            'address'=>'required',
            'dob'=>'required',
            'phone_number'=>'required',
            'squad_id'=>'required'
        ]);

        $dob = $request->dob;
        $now = new DateTime();
        $birthdate = new DateTime($dob);
        $age = $birthdate->diff($now)->y;

        $prefix = 'MEMBER';
        $length = 8;
        $membershipId = $prefix . substr(uniqid('', true), -10) . substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
        $swimmerData = [
            'user_id'=>$userId,
            'gender'=>$request->gender,
            'swimmer_type'=>$age>18?'adult':'child',
            'swimmer_status'=>'active',
            'membership_id'=>$membershipId,
            'squad_id'=>$request->squad_id
        ];
        $validatedData['user_id'] = auth()->user()->id;
        $personalInfo = $this->personalInfoService->findByUserId($userId);
        if($personalInfo){
            $info = $this->personalInfoService->update($validatedData,$personalInfo->id);
        }
        else{
            $swimmer = $this->swimmerService->create($swimmerData);
            $info = $this->personalInfoService->create($validatedData);
        }
        
        if($info){
            return redirect()->back()->with(['alert-type'=>'success','message'=>'Personal Information has been updated']);
        }
        
    }
}
