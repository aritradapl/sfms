@extends('adminlte::page')

@section('title', 'Edit Department')

@section('content_header')
    <h1>Edit Department</h1>
@stop

@section('content')
<form id="form" action="{{route('department.edit.post',$department[0]->id)}}" method="post">
    @csrf
    <div class="container">
    <div class="form-group">
            <label for="dept">Department Name</label>
            <input type="text" class="form-control" id="dept" name="dept" placeholder="Example:Tution,Drawing" value="{{$department[0]->department_name}}">
            <span class="text-danger">
                @error('dept')
                    {{$message}}
                @enderror
            </span>
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Submit">
        <a href="{{url('admin/department/list')}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Back">Back</a>
    </div>
</form>
@stop

@section('css')

@stop

@section('js')
<script src="{{asset('admin/department_management/js/index.js')}}" type="text/javascript"></script>
<script>
   $( document ).ready(function() 
    {
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
@stop