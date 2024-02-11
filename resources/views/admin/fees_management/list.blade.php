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
                            @if ($students->count() > 0)
                                @foreach ($students as $student)
                                    {{-- Group payments by year for the current student --}}
                                    @php
                                        $paymentsByYear = $student->amounts->groupBy('year_id');
                                    @endphp

                                    {{-- Loop through each year --}}
                                    @foreach ($paymentsByYear as $yearId => $payments)
                                        {{-- Find the year object --}}
                                        @php
                                            $year = $years->where('id', $yearId)->first();
                                        @endphp

                                        {{-- Start a new row for each year --}}
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->department->department_name }}</td>
                                            <td>{{ $year->year }}</td>

                                            {{-- Loop through each month --}}
                                            @foreach ($months as $month)
                                                <td>
                                                    {{-- Check if the student has a payment for this month and year --}}
                                                    @if ($payments->contains('month_id', $month->id))
                                                        Paid
                                                    @else
                                                        <!-- Display empty cell if payment not found -->
                                                    @endif
                                                </td>
                                            @endforeach

                                            <td class="text-center py-0 align-middle">
                                                {{-- Add action buttons here --}}
                                                <a href="{{ route('fees.delete', $student->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
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
