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
		<li><a href="/index.php/college/batch/active">Home</a></li>
		<li><a href="#" onclick="window.history.go(-1); return false;">Back</a></li>
		<li class="active">Batch Details</li>
	</ul>
	</div>


	<span  class="Batch_detail_container">


		   <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs1">
				<li class="active"><a href="#Batch_home" data-toggle="tab"><span class="glyphicon glyphicon-home">
                </span>Home</a></li>
				
				<li><a href="/index.php/college/batchinstance/{!! $batch_details->batch_id !!}"><span class="glyphicon glyphicon-print"></span>
						Report</a></li>

			</ul>
		<!-- Tab panes -->
            <div class="tab-content">
				<div class="tab-pane tab-pane1 fade in active" id="Batch_home">
					<div class="list-group">
						<div class="list-group-item">

						 @if (session()->has('message'))
<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <center> {!! session('message') !!} </center>
  {!! session()->forget('message') !!}
</div>
@endif
							
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">Batch Id : </label>
								</div>
								<div class="col-md-3">
									<span>{!! $batch_details->batch_id !!}</span>
								</div>
								<div class="col-md-3"></div>
							</div>

							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">Degree : </label>
								</div>
								<div class="col-md-3">
									<b>{!! $batch_details->degree_subtype_name !!}</b> / <span>{!! $batch_details->course_name !!}</span>
								</div>
								<div class="col-md-3"></div>
							</div>
							
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">Batch : </label>
								</div>
								<div class="col-md-3">
									<span>{!! $batch_details->batch_year !!} - {!! $batch_details->batch_year_to !!}</span>
								</div>
								<div class="col-md-3"></div>
							</div>


							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">Student Strength : </label>
								</div>
								<div class="col-md-3">
									<span>{!! $batch_details->student_count !!}</span>
								</div>
								<div class="col-md-3"></div>
							</div>

							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">HOD details : </label>
								</div>
								<div class="col-md-3">
									@if($batch_details->hod_name)
									<span>{!! $batch_details->hod_name !!}</span><br>
									<span>{!! $batch_details->hod_email !!}</span><br>
									<span>{!! $batch_details->hod_mobile !!}</span><br>
									@else
									<span class="help-text">- Not Mentioned -</span>
									@endif
								</div>
								<div class="col-md-3"></div>
							</div>

							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">Class Teacher details : </label>
								</div>
								<div class="col-md-3">
									@if($batch_details->class_teacher_name)
									<span>{!! $batch_details->class_teacher_name !!}</span><br>
									<span>{!! $batch_details->class_teacher_email !!}</span><br>
									<span>{!! $batch_details->class_teacher_mobile !!}</span><br>
									@else
									<span class="help-text">- Not Mentioned -</span>
									@endif
								</div>
								<div class="col-md-3"></div>
							</div>
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">Class Leader details : </label>
								</div>
								<div class="col-md-3">
									@if($batch_details->rep_name)
									<span>{!! $batch_details->rep_name !!}</span><br>
									<span>{!! $batch_details->rep_email !!}</span><br>
									<span>{!! $batch_details->rep_mobile !!}</span><br>
									@else
									<span class="help-text">- Not Mentioned -</span>
									@endif
								</div>
								<div class="col-md-3"></div>
							</div>


							

							<br>
							<center>
									<div class="input-group">
									<a type="button" class="btn btn2" href="/index.php/{!! $batch_details->batch_id !!}/college/edit_batch"> Edit Batch </a>
										&nbsp;
									<a type="button" class="btn btn-danger" href="/index.php/create_batch_instance/{!! $batch_details->batch_id !!}"> Assign Test </a>
									</div>

									Created On : <span class="note"><?php
								 $date = date_create($batch_details->created_on);
								 echo date_format($date, 'jS M y - g:i A');
								 ?></span>
									
									
							</center>


						</div>
					</div>
				</div>

			</div>
		<!-- Tab panes -->
           </span>
</div>

@stop
