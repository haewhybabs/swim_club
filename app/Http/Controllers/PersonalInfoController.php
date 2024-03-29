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
    public function loadInfo(Request $request){
        $userId = auth()->user()->id;
        $parent = auth()->user()->role_id ==4?true:false;
        if($parent){
            $swimmer = $this->swimmerService->findByParentId($userId);
            $userId= $swimmer->user_id;
        }
        
        $personalInfo = $this->personalInfoService->findByUserId($userId);
        $swimmer = $this->swimmerService->findByUserId($userId);
        $squads = $this->squadService->findAll();
        return view('user.personal_info',compact('personalInfo','swimmer','squads','userId'));
    }
    public function saveUserInfo(Request $request){
        $userId = $request->user_id;
        $validatedData = $request->validate([
            'address'=>'required',
            'dob'=>'required',
            'phone_number'=>'required',
            // 'squad_id'=>'required'
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
        $validatedData['user_id'] = $userId;
        $personalInfo = $this->personalInfoService->findByUserId($userId);
        if($personalInfo){
            $info = $this->personalInfoService->update($validatedData,$personalInfo->id);
            $swimmerInfo = [
                'swimmer_type'=>$age>18?'adult':'child',
            ];
            $updateSwimmer = $this->swimmerService->updateByUserId($swimmerInfo,$userId);
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
