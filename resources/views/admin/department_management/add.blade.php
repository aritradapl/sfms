@extends('adminlte::page')

@section('title', 'Add Department')

@section('content_header')
    <h1>Add Department</h1>
@stop

@section('content')
<form id="form" action="{{route('department.post')}}" method="post">
    @csrf
    <div class="container">
    <div class="form-group">
            <label for="dept">Department Name</label>
            <input type="text" class="form-control" id="dept" name="dept" placeholder="Example:Tution,Drawing" value="{{old('dept')}}">
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