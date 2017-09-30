@extends('layouts.page')
@section('content')
<style>
a{
	color:black;
}

</style>

<div class="homecontainer">
	<div id="test" class="tab-pane tab-pane1 fade in test">

		<hr />
		<div class="row">
			<div class="col-sm-3 col-md-2">
				<form action="/index.php/create_test">
					<button class="btn btn-warning btn-sm btn-block" role="button">CREATE TEST</button>
				</form>
				<hr />
				<ul class="nav nav-pills nav-pills1 nav-stacked">
					@if($status == 'active')
					<li class="active"><a href="/index.php/admin/test/active">Active <span class="badge pull-right">{!! $count[0]->test_active !!}</span></a></li>
					@else
						<li><a href="/index.php/admin/test/active">Active <span class="badge pull-right">{!! $count[0]->test_active !!}</span></a></li>
					@endif

					@if($status == 'inactive')
							<li class="active"><a href="/index.php/admin/test/inactive">In active <span class="badge pull-right">{!! $count[0]->test_inactive !!}</span></a></li>
					@else
							<li><a href="/index.php/admin/test/inactive">In active <span class="badge pull-right">{!! $count[0]->test_inactive !!}</span></a></li>
					@endif

					@if($status == 'finished')
							<li class="active"><a href="/index.php/admin/test/finished">Finished <span class="badge pull-right">{!! $count[0]->test_finished !!}</span></a></li>
					@else
							<li><a href="/index.php/admin/test/finished">Finished  <span class="badge pull-right">{!! $count[0]->test_finished !!}</span></a></li>
					@endif


					<li><a href="/index.php/admin/questionpaper/active">Question Papers</a></li>
					<li><a href="/index.php/attendtest/1"  onClick="return popup(this, 'notes')">Pop up</a></li>



				</ul>
			</div>
			<div class="col-sm-9 col-md-10">

		  <span class="test_list" >
				@if($search_key != "%%")
			  		<div class="row">

						<h4>Search result for ... &nbsp;&nbsp;&nbsp;
							<i class="search_key"> {!! $search_key !!} </i>
						</h4>

					</div>
			    @endif

		     <div class="table-responsive">
				 <table class="table">
					 <thead>
					 <tr>
						 <th>Test Id</th>
						 <th>Title</th>
						 <th>Question Id</th>
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
							 {!! Form :: open(['url' => '/admin/test/'.$status]) !!}
							 <div class="input-group" style="width: 98%">
								 @if($search_key != "%%")
								 <input class="form-control" name="search_key" placeholder="Search by Test id or name ... " value="{!! $search_key !!}">
								 @else
									 <input class="form-control" name="search_key" placeholder="Search by Question Paper id or name ... ">
								 @endif
									 <span class="input-group-btn">
                       				 <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Search</button>
                    				</span>
									 @if($search_key != "%%")
								 	<span class="input-group-btn">
                       				 <a href="/index.php/admin/test/active" type="button" class="btn btn-default"><i class="glyphicon glyphicon-remove"></i> Reset</a>
                    				</span>@endif
							 </div>
							 {!! Form :: close() !!}
						 </th>
						 @else
							 <th colspan="7">
								 <center>
									 No records found ...
								 </center>
							 </th>
						 @endif
					 </tr>
					 </tfoot>
					 <tbody>
					 @foreach($test_details as $tkey => $tvalue)
						 <tr class="row_hover" onclick="location.href='/index.php/admin/view_test/{!! $tvalue->test_id !!}'">
							 <td>{!! $tvalue->test_id !!}</td>
							 <td> {!! $tvalue->title !!}</td>
							 <td>{!! $tvalue->qp_id !!}</td>
							 <td> {!! $tvalue->number_of_questions !!}</td>
							 <td>{!! $tvalue->total_marks !!}</td>
							 <td>{!! $tvalue->duration !!}</td>
							 <td> <?php
								 $date = date_create($tvalue->created_on);
								 echo date_format($date, 'jS M y - g:i A');
								 ?>
							 </td>
							 <td>
								 <a href="/index.php/{!! $tvalue->test_id !!}/admin/edit_test" class="btn btn2 href2">Edit</a>
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