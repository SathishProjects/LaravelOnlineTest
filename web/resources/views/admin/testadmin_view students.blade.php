@extends('layouts.page')
@section('content')
    <style>
        a{
            color:black;
        }

    </style>
    
	
	<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
	
    <div class="homecontainer container">
        
        <div class="row">
		<center><h3>{!! $testdetails[0]->title !!}</h3></center>
		
		<center><h4 class="note">{!! '( '. $testdetails[0]->degree .' / '.  $testdetails[0]->branch .' )' !!}</h4></center>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <center>
						
						<?php $active = 0; $inactive = 0; ?>
						
						@foreach($student_details_list as $key => $val)
							@if($val->status)
								<?php $active++; ?>
							@else
								<?php $inactive++;?>
							@endif
						@endforeach
						
                            <b>Total Students : <span class="badge"> {!! $testdetails[0]->total_students !!} </span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b>Logged in : <span class="badge"> {!! count($student_details_list) !!} </span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b>Active : <span class="badge"> {!! $active !!} </span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b>In Active : <span class="badge"> {!! $inactive !!} </span></b><br><br>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
            <div class="col-md-12"  style="overflow-x: auto">

            <table class="table table-bordered">
                <thead>
                <th>#</th>
                <th>Student id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Login</th>
                <th>Logout</th>
                <th>Time taken (Mins)</th>
                <th>Action</th>
                </thead>
                
                <tbody>

                @foreach($student_details_list as $sdkey => $sdval)
                <tr>
                    <td>{!! $sdkey+1 !!}</td>
                    <td>{!! $sdval->student_id !!}</td>
                    <td>{!! $sdval->name !!}</td>
                    <td>{!! $sdval->email !!}</td>
                    <td>
                        <?php
                        $date1 = date_create($sdval->login_time);
                        echo date_format($date1, 'jS M y - g:i A');
                        ?>
                    </td>
                    <td>
                        @if($sdval->logout_time)
                        <?php
                        $date2 = date_create($sdval->logout_time);
                        echo date_format($date2, 'jS M y - g:i A');
                        ?>
                        @else
                        {{'-'}}
                        @endif
                    </td>
                    <td>
                        @if($sdval->logout_time)
                        <?php
                            $t1 = $sdval->login_time;
                            $t2 = $sdval->logout_time;
                        $from_time = strtotime($t1);
                        $to_time = strtotime($t2);
                        echo round(abs($to_time - $from_time) / 60,2);
                        ?>
                        @else
                            {{'-'}}
                        @endif
                    </td>
                    <td>
                        @if($sdval->status)
                       <button class="btn btn-default Reappear" data-toggle="tooltip" data-placement="left"  title="Re-appear" value="{!! $sdval->email !!}" value_name="{!! $sdval->name !!}"><i class="fa fa-refresh"></i></button>
                        @else		
                        <button class="btn btn-default" disabled title="Re-appear"><i class="fa fa-refresh"></i></button>
                        @endif
                    </td>
                </tr>
                    @endforeach

                </tbody>
            </table>

            </div>

        </div>

    </div>
	
	<div id="Reappear_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Reappear_modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-body">
		
		 <form role="form" name="reappear_form" id="reappear_form" class="reappear_form">
                                    
									<div class="row">
										<div class="col-md-3 ">
											<label for="email" class="pull-right">Student Name :</label> 
										</div>
										<div class="col-md-9">
											<span class="show_name"></span>
										</div>
                                    </div>
									
									<div class="row">
										<div class="col-md-3 ">
											<label for="email" class="pull-right">Email id :</label> 
										</div>
										<div class="col-md-9">
											<span class="show_email"></span>
										</div>
                                    </div>
									<br>
									<div class="row">
										
										<div class="col-md-12">
											
										<input type="hidden" class="form-control reappear_email" id="email" name="email" placeholder="Email">
										<input type="hidden" name="test_login_id" value="{{ $testdetails[0]->testinstance }}">
                                        <textarea class="form-control" id="reason" name="reason" placeholder="Reason for re-appear "></textarea>
										<br>
                                    <span class="note">
                                        Note :
                                        <ol>
                                        <li>A student should reappear only for technical issues or critical problems</li>
                                        <li>A student can reappear maximum 3 times olny</li>
                                        </ol>
                                    </span>
										</div>
                                    </div>
									
									<br>
                                    <center>
				<button type="button" class="btn btn-default reappear">Re-Appear</button>
				<button type="button" class="btn btn2 href2" data-dismiss="modal">Close</button>
			</center>	
                                    

                            </form>
							
							
      </div>
      </div>
	</div>
	</div>
	
	<div id="admin_feedback" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-body">
		<h4 class="note return_message center">Test Ended succesfully !</h4> 
		<div class="row feedback_form">
                                    <div class="col-md-12 bg-danger padding15px">
                                        <b>How shall we improve more ?</b><br><br>
                                       

                            
                                    </div>
                                </div>
								
      </div>
    </div>
  </div>
</div>

@stop


