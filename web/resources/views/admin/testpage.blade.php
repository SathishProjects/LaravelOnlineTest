@extends('layouts.test_page')
@section('content')
    <style>
        @media only screen and (min-width: 768px){
            #header .head-right {
                margin-top: 25px !important;
                margin-right: -117px !important;
            }}
        body{
            padding-top: 15px !important;
        }
		

    </style>

	
    <script type="text/javascript">

    $(document).ready(function() {
        var c =  parseInt($('.duration').val());

        var t;
        timedCount();

        $(document).on('click', '.next_url,.test_submit', function(){


        clearTimeout(t);

         });

        function timedCount() {
            var hours = parseInt(c / 3600) % 24;
            var minutes = parseInt(c / 60) % 60;
            var seconds = c % 60;

            var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds < 10 ? "0" + seconds : seconds);

            $('.timer').html(result);

            var hms = result;
            var a = hms.split(':');
            var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);

            $('.duration').val(seconds);

            if (c == 0) {
				
				$(window).unbind('beforeunload');
				$(window).unbind();
                window.location = "/index.php/test/logout/{!! $ids->test_id !!}";
            }
            c = c - 1;
            t = setTimeout(function () {
                        timedCount()
                    },
                    1000)}
    
    });

    window.opener.close();
    window.onload = showwindow;

    $(document).ready(function(){
        $(document).on("keydown", keypressaction);
    });

    $(window).bind('click', function(event) {
        if(event.target.href)
            $(window).unbind('beforeunload');
    });
    $(window).bind('beforeunload', function(event) {
        return "Leaving this page will logout from test";
    });

    $(document).on('click', '.test_submit', function(){
        $(window).unbind();
    });

    $(document).on('click', '.test_submit1', function(){
        setTimeout(function(){ window.close(); }, 10000);
    });

    $(document).bind('contextmenu', function (e) {
        e.preventDefault();
        alert('Right Click is not allowed');
    });

    </script>


    <div class="container">
            <div class="col-md-12">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="pull-right">
                        <span class="note">Time left :</span>
                        <span class="timer"></span>


                            <button  type="button" class="btn btn1 href1 finishtest">Finish Test</button>

                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel-group">
                                <div class="panel ">

                                    <?php
                                    $alphabet = range('A', 'Z');
                                    ?>

                                        @foreach($subject as $sskey => $ssvalue)
                                            @if($ssvalue == $current_question_records[0]->section_subject)
                                        <?php $mykey = $sskey;?>
                                            @endif
                                        @endforeach


                                    <div class="panel-heading header-style">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <h4>Section - {!! $alphabet[$mykey] !!} {!! '( '.$subject[$mykey].' )' !!}</h4>
                                            </div>
                                            <div class="col-xs-6">
                                                <span class="pull-right marginright10px"><b>Answered : </b>{!! $finished_records !!} out of {!! $ids->number_of_questions !!} </span>
                                            </div>
                                        </div>
                                    </div>

                                    @foreach($section_records as $skey => $sval)

                                        @if($sval->section_id == $current_question_records[0]->section_id && $sval->terms_conditions != null)
                                                <div class="col-xs-12">
                                           <div class="row section_instruction"> 
                                                <div class="col-xs-12">
                                                    <br>
                                                    <p>
                                                        <b>Direction :</b>
                                                        {!! $sval->terms_conditions !!}
                                                    </p>
                                                    @if($sval->section_question != null)
                                                        <b>Question Paragraph : </b>{!! $sval->section_question !!}
                                                    @endif
                                                    @if($sval->question_image != null)
                                                        <div class="row">

                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-6">
                                                                <img src="{!! $sval->question_image !!}">

                                                            </div>
                                                            <div class="col-md-3"></div>

                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                                </div>
                                        @endif

                                    @endforeach
                                        <form role="form" action="/index.php/test/submit_question" method="post" class="submit_question_form">
                                    <br>
									<div class="panel-body" style="overflow-y: auto; position: relative; height: 500px;">

                                            


                                            <input type="hidden" value="{!! $ids->test_id !!}" name="test_id"/>
                                            <input type="hidden" value="{!! $ids->test_id !!}" class="test_id" name="test_id"/>
                                            <input type="hidden" value="{!! $current_question_records[0]->qp_id !!}" name="qp_id"/>
                                            <input type="hidden" value="{!! $current_question_records[0]->section_id !!}" name="section_id"/>
                                            <input type="hidden" value="{!! $current_question_records[0]->section_order_id !!}" name="section_order_id"/>
											<input type="hidden" value="{!! $current_question_records[0]->subject_id !!}" name="subject_id"/>
                                            <input type="hidden" value="{!! $current_question_records[0]->qpq_order_id !!}" name="qpq_order_id"/>
                                            <input type="hidden" value="{!! $current_question_records[0]->qpq_id !!}" name="qpq_id"/>
                                            <input type="hidden" value="{!! $ids->duration !!}" class="duration" name="duration"/>

                                            <input type="hidden" value="{!! session('user_authenticated.id') !!}" class="user_id" name="user_id"/>    
                                            <input type="hidden" value="{!! session('user_authenticated.reg_id') !!}" class="student_id" name="student_id"/>

                                            @if($current_question_records[0]->response_qpqa_id == '0')
                                                <input type="hidden" value="create" name="action"/>
                                                @else
                                                <input type="hidden" value="update" name="action"/>
                                            @endif

                                            @foreach($subject as $key => $value)
                                            <?php $question_id=0; ?>
                                            @foreach($section_records as $skey => $sval)
                                                @if( $sval->section_subject == $value )
                                                    @for($x=1;$x<=$sval->number_of_questions_section;$x++)
                                                        @if(($current_question_records[0]->section_order_id == $sval->section_value)&&($current_question_records[0]->qpq_order_id == $x))
                                                            <?php $current_question_id = $question_id+1;?>
                                                        @endif
                                                            <?php $question_id = $question_id+1;?>
                                                    @endfor
                                                @endif
                                            @endforeach
                                            @endforeach

                                            <b>
                                                Q.{!! $current_question_id !!}
                                                {!! $current_question_records[0]->question_text !!}
                                            </b>

                                            @if($current_question_records[0]->question_image)
                                            <div class="row">

                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                    <img src="{!! $current_question_records[0]->question_image !!}">

                                                </div>
                                                <div class="col-md-3"></div>

                                            </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-md-12">
												
												 <?php shuffle($current_option_records) ?> 

                                                    @foreach($current_option_records as $optkey => $optval)
                                                    <div class="option">
                                                        @if($optval->qpqa_id == $current_question_records[0]->response_qpqa_id)
                                                        <input type="radio" name="response_qpqa_id" value="{!! $optval->qpqa_id !!}" checked/>
                                                        @else
                                                            <input type="radio" name="response_qpqa_id" value="{!! $optval->qpqa_id !!}"/>
                                                        @endif
                                                        @if($optval->answer_image)
                                                        <img src="{!! $optval->answer_image !!}"><br>
                                                        @endif
                                                        @if($optval->answer_text)
                                                             {!! $optval->answer_text !!}
                                                        @endif
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
											<br>
											
                                    </div>
									
									<center>
                                                <button type="submit" class="btn btn2 href2 test_submit" style="bottom: 15px; position: fixed;">Save / Next</button>

                                            </center>
                                        
                                        </form>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 margintop1percent">

                            <div class="panel-group" id="accordion">

                                @foreach($subject as $key => $value)
                                    <?php $question=1; ?>
                                    <div class="panel panel-default ">
                                        <div class="panel-heading">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#{!! 'section'.$key !!}">
                                                <h4 class="panel-title"><span>Section - {!! $alphabet[$key] !!}</span> &nbsp;&nbsp;&nbsp;<span class="badge badge-success"> {!! $subject_finished_notfinished_count[$key]['finished'] !!} </span>  <span class="badge badge-danger"> {!! $subject_finished_notfinished_count[$key]['notfinished'] !!} </span> of <span class="badge">{!! $subject_finished_notfinished_count[$key]['total'] !!}</span></h4>
                                            </a>
                                        </div>

                                        @if($current_question_records[0]->section_subject == $value)
                                            <div id="{!! 'section'.$key !!}" class="panel-collapse collapse in {!! $current_question_records[0]->section_subject !!} {!! $value !!}">
                                        @else
                                            <div id="{!! 'section'.$key !!}" class="panel-collapse collapse {!! $current_question_records[0]->section_subject !!} {!! $value !!} ">
                                        @endif

                                            <div class="panel-body">
                                                @foreach($section_records as $skey => $sval)
                                                    @if( $sval->section_subject ==$value)
                                                        @for($x=1;$x<=$sval->number_of_questions_section;$x++)
                                                            @if(($current_question_records[0]->section_order_id == $sval->section_value)&&($current_question_records[0]->qpq_order_id == $x))
                                                                <button value="/index.php/test_details/{!! $ids->test_id !!}/{!! $sval->section_value !!}/{!! $x !!}/{!! session('user_authenticated.id') !!}/{!! session('user_authenticated.reg_id') !!}" class='btn btn-circle btn-default next_url' style="border: 3px solid blue;padding: 0px;"><?php echo $question;$question=$question+1;?></button>
                                                            @elseif(in_array($x,$sval ->finished_questions))
                                                                <button value="/index.php/test_details/{!! $ids->test_id !!}/{!! $sval->section_value !!}/{!! $x !!}/{!! session('user_authenticated.id') !!}/{!! session('user_authenticated.reg_id') !!}" class='btn btn-circle btn-success next_url'><?php echo $question;$question=$question+1;?></button>
                                                            @else
                                                                <button value="/index.php/test_details/{!! $ids->test_id !!}/{!! $sval->section_value !!}/{!! $x !!}/{!! session('user_authenticated.id') !!}/{!! session('user_authenticated.reg_id') !!}" class='btn btn-circle btn-danger next_url'><?php echo $question;$question=$question+1;?></button>
                                                            @endif
                                                        @endfor
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                                <div class="panel panel-default ">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button class="btn btn-circle btn-success"></button> - <label>Answered </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button class="btn btn-circle btn-danger"></button> - <label>Not answered</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button class="btn btn-circle btn-default" style="border: 3px solid blue;padding: 0px;"></button> - <label>Current Question</label>
                                            </div>
                                        </div>
										
                                    </div>
                                </div>





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body">
		<center><h4 class="modal-title">Are you sure to finish test ?</h4></center>
		<br>
          <table class="table table-bordered">
                <thead>
                <tr><th>Section</th>
				
				<th>No.of.Questions</th>
                <th>Attended</th>
                <th>Not attended</th>
                
                </tr>
				</thead>
				
                <tbody>
				<?php  $notfinished = 0; ?>
					@foreach($subject as $sskey => $ssvalue)
					<?php  $notfinished = $notfinished + $subject_finished_notfinished_count[$sskey]['notfinished']; ?>
                        <tr>
                        <td>{{ $ssvalue}}</td>
                        <td>{!! $subject_finished_notfinished_count[$sskey]['total'] !!}</td>
                        <td>{!! $subject_finished_notfinished_count[$sskey]['finished'] !!}</td>
                        <td>{!! $subject_finished_notfinished_count[$sskey]['notfinished'] !!}</td>
						</tr>
                    @endforeach
					
                        <tr>
                        <td><b>Total :</b></td>
                        <td> {{ $ids->number_of_questions }}</td>
                        <td> {{ $finished_records }}</td>
                        <td>{{ $notfinished }}</td>
						</tr>
						
                </tbody>
            </table>
        
		<center>
		@if($notfinished != 0)
		<h5 class="note"><i class="glyphicon glyphicon-warning-sign"></i> Warning ... You have {{ $notfinished }} unanswered Questions !</h5>
		@endif
			<button class="btn btn2 href2" data-dismiss="modal">Go Back to Test</button>
			<a href="/index.php/test/logout/{!! $ids->test_id !!}/{!! $ids->batch_id !!}" type="submit" class="btn btn1 href1 test_submit1" name="logout" value="logout">Finish Test</a>
		</center>
		</div>
        
      </div>
      
    </div>
  </div>
@stop

