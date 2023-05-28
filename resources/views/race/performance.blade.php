@extends('layouts.main')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Race Performance</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                @php $roleId = auth()->user()->role_id @endphp
                @if($roleId==1 || $roleId ==2)
                <ol class="breadcrumb text-right">
                    <a href="{{ URL::TO("create-performance") }}" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Create Performance </a>
                </ol>
                @endif
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
                        <button class="btn btn-success" data-toggle="modal" data-target="#filter">Filter</button>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Stroke</th>
                                    <th>Duration</th>
                                    <th>Distance</th>
                                    <th>Date</th>
                                    <th>Score</th>
                                    <th>Event</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php $x =1 @endphp
                                @foreach ($performances as $performance)
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td>{{ $performance?->swimmer?->user?->name }}</td>
                                        <td>{{ $performance->race_type }}</td>
                                        <td>{{ $performance->stroke->name }}</td>
                                        <td>{{ $performance->duration}}</td>
                                        <td>{{ $performance?->distance?->name}}</td>
                                        <td>{{ $performance->training_date}}</td>
                                        <td>{{ $performance->performance_score}}</td>
                                        <td>{{ $performance?->galaEvent?->name}}</td>
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
  
        <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Create Race Performace</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ URL::TO("handle-create-performance") }}" method="post">
                @csrf
                    <div class="form-group">
                        <label>Select Swimmer</label>
                        <select class="form-control" name="swimmer_id" required>
                            @foreach($swimmers as $swimmer)
                                <option value="{{ $swimmer->id }}">{{ $swimmer->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Select Race Type</label>
                        <select class="form-control" name="race_type" required>
                            <option value="Training">Training</option>
                            <option value="Event">Gala Event</option>
                        </select>
                    </div>

                    <div class="form-group">
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
                    </div>
                    <div class="form-group">
                        <label>Enter duration</label>
                        <input type="text" name="duration" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label>Time (optional)</label>
                        <input type="datetime-local" name="training_date" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label>Performance Score (optional)</label>
                        <input type="datetime" name="performance_score" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label>Gala Event (optional)</label>
                        <select class="form-control" name="gala_event_id">
                            <option value="0">Select Gala Event</option>
                            @foreach($galaEvents as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
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

<div class="modal" id="filter">
    <div class="modal-dialog">
        <div class="modal-content">
  
        <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Filter Race Data</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ URL::TO("race-performance") }}" method="get">
            
                
                    <div class="form-group">
                        <label>Filter by Distance (Optional)</label>
                        <select class="form-control" value="{{ $distanceFilter }}" name="distance_id_filter">
                            <option value="0">Select Distance</option>
                            @foreach($distances as $distance)
                                <option value="{{ $distance->id }}" {{ $distanceFilter==$distance->id?'selected':'' }}>{{ $distance->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Filter by Stroke (Optional)</label>
                        <select class="form-control" name="stroke_id_filter" value="{{ $strokeFilter }}">
                            <option value="0">Select Stroke</option>
                            @foreach($strokes as $stroke)
                                
                                <option value="{{ $stroke->id }}" {{ $strokeFilter==$stroke->id?'selected':'' }}>{{ $stroke->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Filter by Race Type (Optional)</label>
                        <select class="form-control" name="race_type_filter">
                            <option value="0">Select Race Type</option>
                            <option value="Training" {{ $raceTypeFilter=='Training'?'selected':'' }}>Training</option>
                            <option value="Event" {{ $raceTypeFilter=='Event'?'selected':'' }}>Gala Event</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Filter by Gala Event (Optional)</label>
                        <select class="form-control" name="gala_event_filter" value="{{ $galaEventFilter }}">
                            <option value="0">Select Gala Event</option>
                            @foreach($galaEvents as $event)
                                <option value="{{ $event->id }}" {{ $galaEventFilter==$event->id?'selected':'' }}>{{ $event->name }}</option>
                            @endforeach
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