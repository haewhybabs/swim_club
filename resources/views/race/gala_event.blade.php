@extends('layouts.main')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Account</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    @php $roleId = auth()->user()->role_id @endphp
                    @if($roleId==1)
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        Create Gala Event
                    @endif
                    </button>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Events</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Gala date</th>
                                    {{-- <th>Distance</th>
                                    <th>Stroke</th> --}}
                                    <th>Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $x=1 @endphp
                                @foreach ($galaEvents as $event)
                                    <tr>
                                        <td>{{ $x}}</td>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->gala_date }}</td> 
                                        {{-- <td>{{ $event->distance->name }}</td>
                                        <td>{{ $event->stroke->name }}</td> --}}
                                        <td>{{ $event->gender }}</td>
                                    </tr>
                                @php $x++ @endphp
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Create an Event</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ URL::TO("admin/handle-create-event") }}" method="post">
                @csrf
                    <div class="form-group">
                        <label>Event Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="Enter the event name" />
                    </div>


                    <div class="form-group">
                        <label>Gala Date </label>
                        <input type="datetime-local" name="gala_date" class="form-control" required/>
                    </div>

                    {{-- <div class="form-group">
                        <label>Select Stroke</label>
                        <select class="form-control" name="stroke_id" required>
                            @foreach($strokes as $stroke)
                                <option value="{{ $stroke->id }}">{{ $stroke->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Select Distance</label>
                        <select class="form-control" name="distance_id" required>
                            @foreach($distances as $distance)
                                <option value="{{ $distance->id }}">{{ $distance->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label>Age group</label>
                        <select required class="form-control" name="race_type">
                            <option value="adult">Adult</option>
                            <option value="children">Children</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Select Gender</label>
                        <select required class="form-control" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                   

                    <button type="submit" class="btn btn-primary">Submit </button>
                </form>
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
    
        </div>
    </div>
</div>

@endsection

