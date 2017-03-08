@extends('layouts.page')
@section('content')

    <style>
        a{
            color:black;
        }
    </style>
    <div class="homecontainer container">
	
	<center>
	<h3>{!! $college_name !!}</h3>
	
	<?php $ActiveStudents = 0;$InActiveStudents = 0;$LoggedInStudents = 0; ?>
		
		@foreach($details as $dkey => $dvalue)
			
		<?php 
			$ActiveStudents =  $ActiveStudents + $dvalue->active_count;
			$InActiveStudents =  $InActiveStudents + $dvalue->loggedout_count;
			$LoggedInStudents =  $LoggedInStudents + $dvalue->loggedin_count;
		?>
		
		@endforeach
		
		<span class="note">Active Students: </span> <span class="badge">{{ $ActiveStudents }}</span>&nbsp;&nbsp;&nbsp;
		<span class="note">InActive Students: </span> <span class="badge">{{ $InActiveStudents }}</span>&nbsp;&nbsp;&nbsp;
		<span class="note">Logged in Students: </span> <span class="badge">{{ $LoggedInStudents }}</span>&nbsp;&nbsp;&nbsp;
		
	</center>
	
	
		
       
	
        @if (session()->has('message'))
            
                <div class="alert alert-success center">
                    {!! session('message') !!}
                    {!! session()->forget('message') !!}
                </div>
           
        @endif
		
        <ul class="timeline">
            @foreach($details as $key => $value)
            <li class="">
                <div class="timeline-badge primary">{!! $value->test_login_id !!}</div>
                <div class="timeline-panel">

                     <div class="row">
                     <div class="col-md-2"></div> 
                       
                        <div class="col-md-4">

                            <div class="row">
                       
                                <div class="col-md-6">
                                        <b class="pull-right">Degree :</b> 
                                </div>

                                <div class="col-md-6">
                                        <span class="note">{!! $value->test_degree_id !!}</span>
                                </div>    
                    
                            </div>
                        
                        </div>

                        <div class="col-md-4">

                             <div class="row">
                       
                                <div class="col-md-6">
                                        <b class="pull-right">Branch :</b> 
                                </div>

                                <div class="col-md-6">

                                    <span class="note">{!! $value->test_branch_id !!}</span>
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
                                        <b class="pull-right">Start time :</b>
                                </div>

                                <div class="col-md-6">
                                @if($value->login_time)
                                        <?php
                            $date1 = date_create( $value->login_time);
                            echo date_format($date1, 'd M y - g:i A');
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
                                        <b class="pull-right">End time :</b>
                                </div>

                                <div class="col-md-6">
                                         @if($value->logout_time)

                                <?php
                                $date2 = date_create( $value->logout_time );
                                echo date_format($date2, 'd M y - g:i A');
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
                                        <b class="pull-right">Total Candidates :</b> 
                                </div>

                                <div class="col-md-6">
                                        <span class="badge">{!! $value->students_count !!}</span>
                                </div>    
                    
                            </div>
                        
                        </div>

                        <div class="col-md-4">

                             <div class="row">
                       
                                <div class="col-md-6">
                                        <b class="pull-right">Logged in :</b> 
                                </div>

                                <div class="col-md-6">
                                    <span class="badge">{!! $value->loggedin_count !!}</span>
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
                                        <span class="badge">{!! $value->active_count !!}</span>
                                </div>    
                    
                            </div>
                        
                        </div>

                        <div class="col-md-4">

                             <div class="row">
                       
                                <div class="col-md-6">
                                        <b class="pull-right">Finished :</b> 
                                </div>

                                <div class="col-md-6">
                                    <span class="badge">{!! $value->loggedout_count !!}</span>
                                </div>    
                    
                            </div>   

                        </div>   
                         <div class="col-md-2"></div>  
                    
                    </div>
                    
                    <div>
                        
                        <center>
						
							<a href='/index.php/testadmin/viewstudents/{{ $value->test_login_id }}' target="_blank" type="button" class="btn btn-danger">View Students</a>
							
                            
							@if($value->logout_time)
									<a href="/index.php/admin/export_testreport/{{$value->test_login_id}}" class="btn btn2"> Download Report </a>
                            @endif
                            </center>
                    </div>
					
					@if($value->login_time && $value->logout_time)
					<div id="ribbon-container">
					<span class="ribboncolor1">
					<a href="javascript:void(0)" id="ribbon" >
						Finished
					</a>
					</span>
					</div>
					@elseif(!$value->login_time && !$value->logout_time)
					<div id="ribbon-container">
					<span class="ribboncolor2">
					<a href="javascript:void(0)" id="ribbon" >
						Not started
					</a>
					</span>
					</div>
					@elseif($value->login_time && !$value->logout_time)
					<div id="ribbon-container">
					<span class="ribboncolor3">
					<a href="javascript:void(0)" id="ribbon" >
						Active
					</a>
					</span>
					</div>
					@endif

                </div>
            </li>
                @endforeach
        </ul>

    </div>

@stop

