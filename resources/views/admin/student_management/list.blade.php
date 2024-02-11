@extends('adminlte::page')

@section('title', 'Students')

@section('content_header')
    <h1>Students</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
                <div id="alert" class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('status') }}
                </div>
            @endif
            @if(session('delete'))
                <div id="alert" class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('delete') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <a href="{{route('student/add')}}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="top" title="Add"><i class="fa fa-plus"></i> Add Student</a></h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered" id="student-table" >
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Gender</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data->count() > 0)
                                @foreach ($data as $arr)
                                    <tr>
                                        <td>{{$arr->name}}</td>
                                        <td>{{$arr->gender}}</td>
                                        <td>{{$arr->phone}}</td>
                                        <td>{{$arr->address}}</td>
                                        <td>{{$arr->department->department_name}}</td>
                                        <td><a href="{{route('student.edit',['id'=>$arr->id])}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit" ><i class="fas fa-edit"></i></a>
                                            <a href="{{route('student.delete',['id'=>$arr->id])}}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" ><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
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
    <script>
        $( document ).ready(function()
        {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $( document ).ready(function()
        {
            $('#student-table').dataTable({})
        });
        setTimeout(function()
        {
            $('#alert').fadeOut(2000);
        },3000);
    </script>
    <!-- Include Alertify.js library -->
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css"/>
    <!-- Include the default theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css"/>
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
