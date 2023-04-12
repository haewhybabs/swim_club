@extends('layouts.main')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>{{ $swimmer?->squad?->squad_name }}</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    {{-- <button>Assign a coach</button> --}}
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
                        <strong class="card-title">Coach: {{ $swimmer?->squad?->coach?->name }}</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Swimmer Type</th>
                                    <th>Membership ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $x =1 @endphp
                                @foreach ($squadSwimmers as $swimmer)
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td>{{ $swimmer->user->name }}</td>
                                        <td>{{ $swimmer->gender }}</td>
                                        <td>{{ $swimmer->swimmer_type }}</td>
                                        <td>{{ $swimmer->membership_id }}</td>
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
@endsection