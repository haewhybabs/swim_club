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
                       Create Coach
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Squad</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $x=1 @endphp
                                @foreach ($coaches as $coach )
                                    <tr>
                                        <td>{{ $x}}</td>
                                        <td>{{ $coach->name }}</td>
                                        <td>{{ $coach->email }}</td>
                                        <td>{{ $coach?->squad?->squad_name }}
                                        <td>
                                            {{-- check for admin --}}
                                            @if (auth()->user()->role_id==1)
                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#update{{ $coach->id }}">Update</a>
                                            <a href="{{ URL::TO("admin/handle-delete-coach") }}/{{ $coach->id }}" class="btn btn-danger">Delete</a>
                                            @endif

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
  
        <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Create a coach</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ URL::TO("admin/handle-create-coach") }}" method="post">
                @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="Enter the coach name" />
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" required placeholder="Enter the coach email" />
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Enter the coach password" />
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

@foreach ($coaches as $coach )

 <div class="modal" id="update{{ $coach->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
    
        <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Update a coach</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ URL::TO("admin/handle-update-coach") }}" method="post">
                @csrf
                    <input type="hidden" name="user_id" value="{{ $coach->id }}" />
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" value="{{ $coach->name }}" name="name" class="form-control" required />
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

@endforeach
@endsection

