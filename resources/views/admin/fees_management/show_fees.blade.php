@extends('adminlte::page')

@section('title', $student[0]->name.' Fees Details')

@section('content_header')

@stop

@section('content')
<div class="container" id="printableArea">
    <center><h2><b>Fees Details of {{$student[0]->name}} <b></h2></center>
    <!-- <form action="{{route('pdf.generate',$student[0]->id)}}" method="POST">
        @csrf -->
        <div class="form-group">
            <label for="studentName">Student Name : {{$student[0]->name}}</label>
        </div>
        <div class="form-group">
            <label for="phone">Mobile Number : {{$student[0]->phone}}</label>
        </div>
        <div class="form-group">
            <label for="gender">Gender : {{$student[0]->gender}}</label>
        </div>
        <div class="form-group">
            <label for="dept">Department : {{$student[0]->department->department_name}}</label>
        </div>
        <div class="form-group">
            <label for="gender">Year :
                {{$student[0]->amounts}}
                {{-- @if($years->count()>0)
                    @foreach ($years as $year)
                        @if($year->id == $student[0]->amounts->year_id)
                            {{ $year->year }}
                        @endif
                    @endforeach
                @endif --}}
            </label>
        </div>
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        @if($months->count()>0)
                            @foreach ($months as $month)
                                <th>{{ $month->month_name }}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                @if($student->count()>0)
                    @foreach ($student as $data)
                        <tr>
                            @foreach ($months as $month)
                                <td>
                                    @php
                                        $payment = $data->amounts->where('month_id', $month->id)->first();
                                    @endphp
                                    @if ($payment)
                                        Paid
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </div>
        </table>
        <!-- <center><input type="submit" class="btn btn-primary" value="Print" data-toggle="tooltip" data-placement="top" title="Print"></center>
    </form> -->
    <center><input type="button" onclick="printableDiv('printableArea')" value="Print" class="btn btn-primary"></center>
</div><br><br><br><br><br><br><br><br><br><br>
<center><footer><p>Developed By<b> Aritra Dutta </b>@Software Developer at DAPL</footer></center>
@stop

@section('js')
    <script>
        $( document ).ready(function()
        {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script type="text/javascript">
        function printableDiv(printableAreaDivId)
        {
            var printContents = document.getElementById(printableAreaDivId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@stop
