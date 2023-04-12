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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                       Create Squad
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
                        <strong class="card-title">Coaches</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Squad Name</th>
                                    <th>Coach</th>
                                    <th>Squad Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $x=1 @endphp
                                @foreach ($squads as $squad )
                                    <tr>
                                        <td>{{ $x}}</td>
                                        <td>{{ $squad->squad_name }}</td>
                                        <td>{{ $squad?->coach?->name }}</td> 
                                        <td>
                                            <a href="{{ URL::TO("my-squad") }}?squad_id={{ $squad->id }}" class="btn btn-info btn-xs">View
                                            </a>

                                            <a href="{{ URL::TO("admin/update-squad") }}?squad_id={{ $squad->id }}" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#squadUpdate{{ $squad->id }}">Update
                                            </a>

                                           
                                        </td>
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
            <h4 class="modal-title">Create a squad</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ URL::TO("admin/handle-create-squad") }}" method="post">
                @csrf
                    <div class="form-group">
                        <label>Squad Name</label>
                        <input type="text" name="squad_name" class="form-control" required placeholder="Enter the squad name" />
                    </div>

                    <div>
                    
                        <label>Select Coach (Optional)</label>
                        <select class="form-control" name="coach_id">
                            <option value="0">Select Coach</option>
                            @foreach ($coaches as $coach )
                                <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                            @endforeach
                        </select>
                    </div><br>
                   

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

@foreach ($squads as $squad )

<div class="modal" id="squadUpdate{{ $squad->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Update a squad</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ URL::TO("admin/handle-create-squad") }}" method="post">
                @csrf
                    <div class="form-group">
                        <label>Squad Name</label>
                        <input type="text" name="squad_name" class="form-control" required placeholder="Enter the squad name" value="{{ $squad->squad_name }}" />
                    </div>

                    <div>
                    
                        <label>Select Coach (optional)</label>
                        <select class="form-control" value="{{ $squad->coach_id }}" name="coach_id" >
                            <option value="0">Select Coach</option>
                            @foreach ($coaches as $coach )
                                <option value="{{ $coach->id }}" {{ $coach->id ==$squad->coach_id? 'selected' :'' }}>{{ $coach->name }}</option>
                            @endforeach
                        </select>
                    </div><br>
                    <input type="hidden" value="{{ $squad->id }}" name="squad_id" />
                   

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

@endforeach
@endsection

