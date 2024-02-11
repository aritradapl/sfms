@extends('adminlte::page')

@section('title', 'Fees Management')

@section('content_header')
    <h1>Add Fees</h1>
@stop

@section('content')
<form id="form" action="{{route('fees.post')}}" method="post">
    @csrf
    <div class="container">
        <div class="form-group">
            <label for="student_id">Student Name</label>
            <select class="form-control" id="student_id" name="student_id">
                <option value="" selected disabled>Select Student</option>
            @if($students->count()>0)
                @foreach ($students as $arr)
                    <option value="{{ $arr->id }}" {{ old('student_id') ==  $arr->id ? 'selected' : '' }}>{{ $arr->name }}</option>
                @endforeach
            @endif
            </select>
            <span class="text-danger">
                @error('student_id')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group d-none" id="year-div">
            <label for="year_id">Year</label>
            <select class="form-control" id="year_id" name="year_id">
                <option value="" selected disabled>Select Year</option>
                @if($years->count()>0)
                    @foreach ($years as $arr)
                        <option value="{{ $arr->id }}" {{ old('year_id') ==  $arr->id ? 'selected' : '' }}>{{ $arr->year }}</option>
                    @endforeach
                @endif
            </select>
            <span class="text-danger">
                @error('year_id')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group d-none" id="month-div">
            <label for="month_id">Month</label>
            <select class="form-control" id="month_id" name="month_id">
                <option value="" selected disabled>Select Month</option>
                @if($months->count()>0)
                    @foreach ($months as $arr)
                        <option value="{{ $arr->id }}" {{ old('month_id') ==  $arr->id ? 'selected' : '' }}>{{ $arr->month_name }}</option>
                    @endforeach
                @endif
            </select>
            <span class="text-danger">
                @error('month_id')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group d-none" id="amount-div">
            <label for="amount">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Example:500" value="{{old('amount')}}">
            <span class="text-danger">
                @error('amount')
                    {{$message}}
                @enderror
            </span>
        </div>
        <input type="submit" name="submit"  id="submit" value="Submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Submit" disabled>
        <a href="{{url('admin/student/fees')}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Back">Back</a>
    </div>
</form>
@stop

@section('css')

@stop

@section('js')
<script src="{{asset('admin/fees_management/js/index.js')}}" type="text/javascript"></script>
<script>
   $( document ).ready(function()
    {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@stop
