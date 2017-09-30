@extends('layouts.page')
@section('content')
    <style>
        a{
            color:black;
        }

    </style>
   
    <div class="homecontainer container">
        
        <div class="row">
		
		<center><h3>{{ $testdetails->title }}</h3></center>
		<center><h4 class="note">{{ $testdetails->degree }} / {{ $testdetails->branch }} ( {{ $testdetails->batch_year }} - {{ $testdetails->batch_year_to }} )</h4></center>	

            <div class="col-md-3"></div>
            <div class="col-md-6"></div>
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
                <th>Time taken</th>
				<th>Attended ( of {{$testdetails->number_of_questions}} )</th>
				<th>Remaining</th>
				<th>Correct</th>
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
                    <td>{{ $sdval->attended }}</td>
					<td>{{ $testdetails->number_of_questions - $sdval->attended }}</td>
					<td>{{ $sdval->correct }}</td>
					<td>
                        @if($sdval->status)
                       <button class="btn btn-default Reappear" data-toggle="tooltip" data-placement="left"  title="Reappear" value="{!! $sdval->email !!}" valuename="{!! $sdval->name !!}"><i class="fa fa-refresh"></i></button>
                        @else
                        <button class="btn btn-default" disabled title="Reappear"><i class="fa fa-refresh"></i></button>
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
										<div class="col-md-12 ">
											<h4 class="text-center">Are you sure to reapper for " <span class="show_email note"></span> " ?</h4>
										</div>
                                    </div>
									<br>
									<div class="row">
										
										<div class="col-md-12">
											
										<input type="hidden" class="form-control reappear_email" id="email" name="email" placeholder="Email">
										
                                        <input type="text" class="form-control" id="reason" name="reason" placeholder="Re-appear reason "/>

                                        <input type="hidden" name="test_id" value="{{ $testdetails->test_id }}" />
										<br>
                                    <span class="help-text">
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


