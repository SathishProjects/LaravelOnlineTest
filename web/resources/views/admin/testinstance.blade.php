@extends('layouts.page')
@section('content')

    <style>
        a{
            color:black;
        }
        body {
     background-color: #ffffff !important; 
    }
    </style>
    <div class="homecontainer container">
        <div class="row">
            <ul class="breadcrumb margintop1">
                <li><a href="/index.php/college/batch/active">Home</a></li>
                <li><a href="#" onclick="window.history.go(-1); return false;">Back</a></li>
                <li class="active">{{$batch_details->degree_subtype_name}} / {{$batch_details->course_name}}  ( {{ $batch_details->batch_year }} - {{ $batch_details->batch_year_to }} )</li>
            </ul>
        </div>

        @if (session()->has('message'))
            
                <div class="alert alert-danger center">
                    {!! session('message') !!}
                    {!! session()->forget('message') !!}
                </div>
           
        @endif
		<div class="well">
		<center>
        <h4 class="note">{{$batch_details->degree_subtype_name}} / {{$batch_details->course_name}}  ( {{ $batch_details->batch_year }} - {{ $batch_details->batch_year_to }} )</h4>
        <h5> BATCH ID - <span class="badge">{{$batch_details->batch_id}}</span>  </h5>

		<a type="button" class="btn btn-danger" href="/index.php/create_batch_instance/{{$batch_details->batch_id}}"> Assign New Test</a>
		<a href="/index.php/college/download_batch_report/{{base64_encode($batch_details->batch_id)}}/{{base64_encode( $batch_details->degree_subtype_name .'_'. $batch_details->course_name)}}" class="btn btn2"  class="btn btn2"> Download batch report </a>
		<a href="/index.php/college/download_batch_students/{{base64_encode($batch_details->batch_id)}}/{{base64_encode( $batch_details->degree_subtype_name .'_'. $batch_details->course_name)}}" class="btn btn-default"> Download students ( {{$batch_details->registered_students}} / {{$batch_details->student_count}} )</a>
		
		
		
		
		</center>
		</div>

        <ul class="timeline">
           
            @foreach( $test_details as $test_key => $test_val )
            <li class="">
                <div class="timeline-badge primary">{{ $test_val->test_id }}</div>
                <div class="timeline-panel">

                    <p class="center">
                    
                     <b>{{ $test_val->title }}</b><br>
                     
                    </p>

                    
                    

                    <div class="row">
                     <div class="col-md-2"></div> 
                       
                        <div class="col-md-4">

                        <div class="row">
                       
                                <div class="col-md-6">
                                        <b class="pull-right">Created :</b> 
                                </div>

                                <div class="col-md-6">
                                @if($test_val->created_on)
                                <?php
                                 $date = date_create($test_val->created_on);
                                 echo date_format($date, 'jS M y - g:i A');
                                 ?>
                                 @else
                                 -
                                 @endif
                                </div>    
                    
                            </div> 

                            
                        
                        </div>

                        <div class="col-md-4">

                               <div class="row">
                       
                                <div class="col-md-6">
                                        <b class="pull-right">Started :</b>
                                </div>

                                <div class="col-md-6">
                                @if($test_val->started_on)
                                <?php
                                 $date = date_create($test_val->started_on);
                                 echo date_format($date, 'jS M y - g:i A');
                                 ?>
                                 @else
                                 -
                                 @endif
                                </div>    
                    
                            </div>

                        </div>   
                         <div class="col-md-2"></div>  
                    
                    </div>

                   

                     <div class="row">
                        <div class="col-md-2"></div> 
                        <div class="col-md-4">

                            <div class="row">
                       
                                <div class="col-md-6">
                                        <b class="pull-right">Ended :</b> 
                                </div>

                                <div class="col-md-6">

                                @if($test_val->ended_on)
                                        <?php
                                 $date = date_create($test_val->ended_on);
                                 echo date_format($date, 'jS M y - g:i A');
                                 ?>
                                 @else
                                 -
                                 @endif
                                </div>    
                    
                            </div>
                        
                        </div>

                        <div class="col-md-4">

                             <div class="row">
                       
                                <div class="col-md-6">
                                        <b class="pull-right">Attended :</b> 
                                </div>

                                <div class="col-md-6">
                                    <span class="badge">{{$test_val->attended}}  / {{ $batch_details->student_count}}</span>
                                </div>    
                    
                            </div>   

                        </div> 
                         <div class="col-md-2"></div>    
                    
                    </div>

                    <div class="row">
                     <div class="col-md-2"></div> 
                       
                        <div class="col-md-4">

                            <div class="row">
                       
                                <div class="col-md-6">
                                        <b class="pull-right">Active :</b> 
                                </div>

                                <div class="col-md-6">
                                        <span class="badge">{{$test_val->active}}</span>
                                </div>    
                    
                            </div>
                        
                        </div>

                        <div class="col-md-4">

                             <div class="row">
                       
                                <div class="col-md-6">
                                        <b class="pull-right">Finished :</b> 
                                </div>

                                <div class="col-md-6">
                                    <span class="badge">{{$test_val->finished}}</span>
                                </div>    
                    
                            </div>   

                        </div>   
                         <div class="col-md-2"></div>  
                    
                    </div>
                    
                    <p>
                        
                        <center>
                        
                            <a href='/index.php/college/viewstudents/{{ $test_val->test_id }}' target="_blank" type="button" class="btn btn1">View Test</a>
                            
                                @if(!$test_val->status)
                                
                                <button type="button" class="btn btn-success starttest" value="{{ $test_val->test_id }}">Start Test</button>

                                <button class="btn btn-danger delete_test" value="{{ $test_val->test_id }}"> Delete Test </button>

                                @endif

                                @if($test_val->status == 2)
                                <a type="button" class="btn btn-danger" href="/index.php/college/export_test_report/{{ $test_val->test_id }}">Download test Report</a>
                                <a href="/index.php/college/export_test_feedback/{{ $test_val->test_id }}" class="btn btn3"> Download feedback ({{$test_val->feedback}})</a>
                                @elseif($test_val->status == 1)
                                <button type="button" class="btn btn2 end_test" value="{{ $test_val->test_id }}">End Test</button>
                                @endif
                            
                            
                                
                           
                            </center>
                    </p>
                    
                    
                    <div id="ribbon-container">
                    <span class="ribboncolor2">
                    <a href="javascript:void(0)" id="ribbon" >
                        Not started
                    </a>
                    </span>
                    </div>
                    

                </div>
            </li>
            @endforeach
             
        </ul>

    </div>

	<div id="confirmation_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Reappear_modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-body">
		<center><h4 class="note"> Are you sure to delete test ( <span class="show_delete_test_id"></span> ) ? </h4></center>					
		<center>
				<button type="button" class="btn btn-danger delete_test_id" >Yes</button>
				<button type="button" class="btn btn2 href2" data-dismiss="modal">No</button>
		</center>
      </div>
      </div>
	</div>
	</div>
	
	
@stop

