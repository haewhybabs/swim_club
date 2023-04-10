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
                       Create Parent
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
                        <strong class="card-title">Parent</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $x=1 @endphp
                                @foreach ($parents as $parent )
                                    <tr>
                                        <td>{{ $x}}</td>
                                        <td>{{ $parent->name }}</td>
                                        <td>{{ $parent->email }}</td>
                                        <td>Edit</td>
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
            <h4 class="modal-title">Create Your Parent</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ URL::TO("create-parent") }}" method="post">
                @csrf
                    <div class="form-group">
                        <label>Select Swimmer</label>
                        <select class="form-control" name="user_id" required>
                            @foreach ($swimmers as $swimmer )
                                <option value="{{ $swimmer->user->id }}">{{ $swimmer->user->name }} ({{ $swimmer->user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="Enter your parent name" />
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" required placeholder="Enter your parent email" />
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Enter your parent password" />
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

