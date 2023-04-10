@extends('layouts.main')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Personal Info</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">{{ auth()->user()?->role?->name }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="col-sm-10">
        <form method="POST" action="{{ URL::TO('save-info') }}">
            @csrf
            <div class="form-group">
                <label>Address</label>
                <input type="text" required name="address" class="form-control" placeholder="address" value="{{ $personalInfo?->address}}"/>
            </div>
            <div class="form-group">
                <label>Date of birth</label>
                <input type="date" required name="dob" class="form-control" placeholder="dob" value="{{ $personalInfo?->dob }}"/>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" required name="phone_number" class="form-control" placeholder="Phone number" value="{{ $personalInfo?->phone_number }}"/>
            </div>
            
        
            <div class="form-group">
                <label>Select Gender</label>
                <select required class="form-control" value="{{ $swimmer?->gender }}" name="gender" {{ $swimmer?->gender ? 'disabled' : '' }}>
                    <option value="male" {{ $swimmer?->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $swimmer?->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="form-group">
                <label>Select Squad</label>
                <select required class="form-control" value="{{ $swimmer?->squad_id }}" name="squad_id" {{ $swimmer?->squad_id ? 'disabled' : '' }}>
                    @foreach ($squads as $squad )
                        <option value="{{ $squad->id }}"  {{ $squad?->id == $swimmer?->squad_id ? 'selected' : '' }}>{{ $squad->squad_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-danger">Submit</button>
        </form>
    </div>
</div>

@endsection