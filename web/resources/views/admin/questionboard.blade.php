@extends('layouts.page')
@section('content')
<style>
a{
	color:black;
}

</style>
<div class="homecontainer">
	<div id="question" class="tab-pane tab-pane1 fade in active question">
		<hr />
		<div class="row">
			<div class="col-sm-3 col-md-2">

				<hr>
					
					<a type="button" href="/index.php/create_batch" class="btn btn-danger btn-sm btn-block" role="button">CREATE BATCH</a>

					<a href="/index.php/create_question" class="btn btn-danger btn-sm btn-block">CREATE QUESTION PAPER</a>
				
				<hr />
				
				<ul class="nav nav-pills nav-pills1 nav-stacked">

						<li><a href="/index.php/college/batch/active"><span class="glyphicon glyphicon-chevron-down"></span> View Batch</a></li>

				</ul>
				
				<ul class="nav nav-pills nav-pills1 nav-stacked">

					@if($status == 'active')
						<li class="active"><a href="/index.php/college/questionpaper/active"><span class="glyphicon glyphicon-chevron-right"></span> Active Qn.Paper<span class="badge pull-right">{!! $count2[0]->qp_active !!}</span></a></li>
					@else
						<li><a href="/index.php/college/questionpaper/active"><span class="glyphicon glyphicon-chevron-down"></span> Active Qn.Paper <span class="badge pull-right">{!! $count2[0]->qp_active !!}</span></a></li>
					@endif


						@if($status == 'inactive')
							<li  class="active"><a href="/index.php/college/questionpaper/inactive"><span class="glyphicon glyphicon-chevron-right"></span> Inactive Qn.Paper  <span class="badge pull-right">{!! $count2[0]->qp_inactive !!}</span></a></li>
						@else
							<li><a href="/index.php/college/questionpaper/inactive"><span class="glyphicon glyphicon-chevron-down"></span> Inactive Qn.Paper <span class="badge pull-right">{!! $count2[0]->qp_inactive !!}</span></a></li>
						@endif

				</ul>
			</div>
			<div class="col-sm-9 col-md-10">
           <span class="question_list">

			   @if($search_key != "%%")
				   <div class="row">

					   <h4>Search result for ... &nbsp;&nbsp;&nbsp;
						   <i class="search_key"> {!! $search_key !!} </i>
					   </h4>

				   </div>
			   @endif

			   <center class="table-responsive">
				   <table class="table">
					   <thead>
					   <tr>
						   <th>QuestionPaperId</th>
						   <th>Title</th>
						   <th>No.of.Qns</th>
						   <th>Marks</th>
						   <th>Duration (Mins)</th>
						   <th>Created On</th>
						   <th></th>
					   </tr>
					   </thead>
					   <tfoot>
					   <tr>
							@if($total_records)
						   <th colspan="5">
							   <div class="">
								   <span class="text-muted"><b>{!! $first_action_value !!}</b>–<b>{!! $last_action_value !!}</b> of <b>{!! $total_records !!}</b></span>
								   <div class="btn-group btn-group-sm">
									   @if($first_action_value <= 1)
										   <button type="button" class="btn btn-default" disabled>
											   <span class="glyphicon glyphicon-chevron-left"></span>
										   </button>
									   @else
										   <a href="{!! Request::url().$previous   !!}" type="button" class="btn btn-default">
											   <span class="glyphicon glyphicon-chevron-left"></span>
										   </a>
									   @endif
									   @if($last_action_value == $total_records)
										   <button type="button" class="btn btn-default" disabled>
											   <span class="glyphicon glyphicon-chevron-right"></span>
										   </button>
									   @else
										   <a href="{!! Request::url().$next   !!}" type="button" class="btn btn-default">
											   <span class="glyphicon glyphicon-chevron-right"></span>
										   </a>
									   @endif
								   </div>
							   </div>
						   </th>


						   <th colspan="3">
							   {!! Form :: open(['url' => '/college/questionpaper/'.$status]) !!}
							   <div class="input-group" style="width: 98%">
								   @if($search_key != "%%")
									   <input class="form-control" name="search_key" placeholder="Search by Question Paper id or name ... " value="{!! $search_key !!}">
								   @else
									   <input class="form-control" name="search_key" placeholder="Search by Question Paper id or name ... ">
								   @endif
									<span class="input-group-btn">
                       				 <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Search</button>
                    				</span>
									   @if($search_key != "%%")
								 	<span class="input-group-btn">
                       				 <a href="/index.php/college/questionpaper/active" type="button" class="btn btn-default"><i class="glyphicon glyphicon-remove"></i> Reset</a>
                    				</span>
										   @endif
							   </div>
							   {!! Form :: close() !!}
						   </th>
						   @else
							   <th colspan="6">
								   <center>
									   No records found ...
								   </center>
							   </th>
						   @endif
					   </tr>
					   </tfoot>
					   <tbody>
					   @foreach($qp_details as $qkey => $qvalue)
						   <tr class="row_hover" onclick="location.href='/index.php/college/view_question_paper/{!! $qvalue->qp_id !!}'">
							   <td>{!! $qvalue->qp_id !!}</td>
							   <td> {!! $qvalue->title !!}</td>
							   <td> {!! $qvalue->number_of_questions !!}</td>
							   <td>{!! $qvalue->total_marks !!}</td>
							   <td>{!! $qvalue->duration !!}</td>
							   <td> <?php
								   $date = date_create($qvalue->created_on);
								   echo date_format($date, 'd M y - g:i A');
								   ?>
							   </td>
							   <td>
								   <a href='/index.php/college/view_question_paper/{!! $qvalue->qp_id !!}' class="btn btn-danger">View</a>
								   <a href="/index.php/{!! $qvalue->qp_id !!}/college/edit_questionpaper" class="btn btn2 href2">Edit</a>
							   </td>
						   </tr>
					   @endforeach
					   </tbody>
				   </table>
			   </div>
		   </span>

			</div>
		</div>


	</div>
</div>

@stop