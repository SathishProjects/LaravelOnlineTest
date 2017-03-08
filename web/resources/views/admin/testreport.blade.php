@extends('layouts.page')
@section('content')
    <style>
        a{
            color:black;
        }

    </style>
    <div class="homecontainer container">
        <div class="row">
            <ul class="breadcrumb margintop1">
                <li><a href="/index.php/admin/test/active">Home</a></li>
                <li><a href="#" onclick="window.history.go(-1); return false;">Back</a></li>
                <li class="active">Test Result</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <h4>Test Result for {!! $testdetails[0]->title !!}</h4>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>

        <span class="pull-left">
					@if(isset($testdetails[0]->testinstance))
                    <a href="/index.php/admin/export_testreport/{!! $testdetails[0]->testinstance !!}"><i class="fa fa-download"></i> Export as xls </a>
					@else
							<a href="/index.php/admin/export_fulltestreport/{!! $testdetails[0]->testmain !!}"><i class="fa fa-download"></i> Export as xls </a>
					@endif
                </span><br>

        <div class="row">
            <div class="col-md-12"  style="overflow-x: auto">

            <table class="table table-bordered">
                <thead>
                <th>#</th>
                <th>Student id</th>
                <th>Name</th>
                <th>Login</th>
                <th>Logout</th>
				<th>Attempt</th>
                <th>Time lapsed (Mins)</th>
				<th>Time taken (Mins)</th>
                
                <th>Attended {{'('.  $testdetails[0]->number_of_questions .')'}}</th>
                <th>Not Attended</th>

                <th>Correct</th>
                <th>Wrong</th>
                
                @foreach($subject as $skey => $sval)
                <th>{{ 'Marks in ' . $sval }}</th>
                @endforeach
                <th>Total {{'('.  $testdetails[0]->number_of_questions .')'}}</th>
                <th>Percent (%)</th>
               
                </thead>
                
                <tbody>

                @foreach($student_details_list as $sdkey => $sdval)
                <tr class="row_hover" onclick="location.href='/index.php/admin/individual_testreport/{!! $sdval->test_login_id !!}/{!! $sdval->student_id !!}'">
                    <td>{!! $sdkey+1 !!}</td>
                    <td>{!! $sdval->student_id !!}</td>
                    <td>{!! $sdval->student_name !!}</td>
                    <td>
                        <?php
                        $date1 = date_create($sdval->login);
                        echo date_format($date1, 'jS M y - g:i A');
                        ?>
                    </td>
                    <td>
                        @if($sdval->logout)
                        <?php
                        $date2 = date_create($sdval->logout);
                        echo date_format($date2, 'jS M y - g:i A');
                        ?>
                        @else
                        {{'-'}}
                        @endif
                    </td>
					<td>{!! $sdval->attempt !!}</td>
					<td>{!! $sdval->time_lapsed !!}</td>
                    
                    <td>
                        @if($sdval->logout)
                        <?php
                            $t1 = $sdval->login;
                            $t2 = $sdval->logout;
                        $from_time = strtotime($t1);
                        $to_time = strtotime($t2);
                        echo round(abs($to_time - $from_time) / 60,2);
                        ?>
                        @else
                            {{'-'}}
                        @endif
                    </td>

                    <td>{!! $sdval->attended !!}</td>
                    <td>{!!  $sdval->not_attended !!}</td>

                    <td>{!!  $sdval->correct !!}</td>
                    <td>{!!  $sdval->incorrect !!}</td>

                    @foreach($subject as $skey => $sval)
                        <td>{!!  $sdval->$sval !!}</td>
                    @endforeach
                    
                    <td>{!! $sdval->correct   !!}</td>
                    <td>
                        {{ ($sdval->correct / $testdetails[0]->number_of_questions)*100 }}
                    </td>
                    
                </tr>
                    @endforeach

                </tbody>
            </table>

            </div>

        </div>

    </div>

@stop


