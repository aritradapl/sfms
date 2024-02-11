@extends('adminlte::page')

@section('title', 'Fees Management')

@section('content_header')
    <h1>Student Fees</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @if(session('status'))
                <div id="alert" class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <a href="{{route('add.fees')}}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="top" title="Add"><i class="fa fa-plus"></i> Add Student Fees</a></h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered" id="fees-table" >
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Department</th>
                                <th>Year</th>
                                    @if($months->count()>0)
                                        @foreach ($months as $month)
                                            <th>{{ $month->month_name }}</th>
                                        @endforeach
                                    @endif
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($students->count()>0)
                            @foreach ($students as $student)
                                @if($student->amounts->count()>0)
                                    @foreach ($student->amounts as $key=>$val)
                                        @if ($val->student_id == $student->id)
                                        <tr>
                                            <td>
                                                {{ $student->name }}
                                            </td>
                                            <td>{{ $student->department->department_name }}</td>
                                            <td>
                                                @if($years->count()>0)
                                                    @foreach ($years as $year)
                                                        @if($year->id == $val->year_id)
                                                            {{ $year->year }}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            @if($months->count()>0)
                                                @foreach ($months as $month)
                                                    <td>
                                                        @if ($month->id == $val->month_id)
                                                            Paid
                                                        @endif
                                                    </td>
                                                @endforeach
                                            @endif
                                            <td class="text-center py-0 align-middle">
                                                {{-- <a href="{{route('fees.show',$student->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View" ><i class="fas fa-eye"></i></a> --}}
                                                {{-- <a href="" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit" ><i class="fas fa-edit"></i></a> --}}
                                                <a href="{{route('fees.delete',$val->id)}}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" ><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<center><footer><p>Developed By<b> Aritra Dutta </b>@Software Developer at DAPL</footer></center>
@stop

@section('js')
    <!-- Include Alertify.js library -->
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css"/>
    <!-- Include the default theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css"/>
    <script>
        $( document ).ready(function()
        {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $( document ).ready(function()
        {
            $('#fees-table').dataTable({})
        });
        setTimeout(function()
        {
            $('#alert').fadeOut(2000);
        },3000);
    </script>
    <script>
        alertify.set('notifier', 'position', 'top-right');
        alertify.set('notifier', 'delay', 5000);
        alertify.set('notifier', 'closeOnClick', true);
        @if(Session::has('success'))
            alertify.success('{{ Session::get("success") }}');
        @endif

        // Check if error message is present in the session and display it
        @if(Session::has('error'))
            alertify.error('{{ Session::get("error") }}');
        @endif
    </script>
@stop
