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
		<li class="active">Test Details</li>
	</ul>
	</div>


	<span  class="test_detail_container">
		   <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs1">
				<li class="active"><a href="#test_home" data-toggle="tab"><span class="glyphicon glyphicon-home">
                </span>Home</a></li>
				<li><a href="#test_profile" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span>
						Settings</a></li>
				<li><a href="#test_question" data-toggle="tab"><span class="glyphicon glyphicon-paperclip"></span>
						Question Paper Details</a></li>
				<li><a href="#test_report" data-toggle="tab"><span class="glyphicon glyphicon-print"></span>
						Report</a></li>
				<li><a href="#settings" data-toggle="tab"><span class="glyphicon glyphicon-plus no-margin">
                </span></a></li>

			</ul>
		<!-- Tab panes -->
            <div class="tab-content">
				<div class="tab-pane tab-pane1 fade in active" id="test_home">
					<div class="list-group">
						<div class="list-group-item">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">Test Id : </label>
								</div>
								<div class="col-md-3">
									<span>{!! $test_details->test_id !!}</span>
								</div>
								<div class="col-md-3"></div>
							</div>

							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">Test Title : </label>
								</div>
								<div class="col-md-3">
									<span>{!! $test_details->title !!}</span>
								</div>
								<div class="col-md-3"></div>
							</div>

							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">Test URL : </label>
								</div>
								<div class="col-md-3">
									<a href="{!! $test_details->test_url !!}" target="_blank">{!! $test_details->test_url !!}</a>
								</div>
								<div class="col-md-3"></div>
							</div>

							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">No.of.Questions : </label>
								</div>
								<div class="col-md-3">
									{!! $test_details->number_of_questions !!}
								</div>
								<div class="col-md-3"></div>
							</div>

							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">Total marks : </label>
								</div>
								<div class="col-md-3">
									{!! $test_details->total_marks !!}
								</div>
								<div class="col-md-3"></div>
							</div>

							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3 text_right">
									<label for="title">Duration : </label>
								</div>
								<div class="col-md-3">
									{!! $test_details->duration !!} Mins
								</div>
								<div class="col-md-3"></div>
							</div>
							<br>
							<center>
								@if($test_details->status == 1)
									<span class="note">Test started at : </span>
									<?php
									$date = date_create($test_details->started_on);
									echo date_format($date, 'jS M y - g:i A');
									?>
								@elseif($test_details->status == 2)
									<span class="note">Test started at : </span>
									<?php
									$date = date_create($test_details->started_on);
									echo  date_format($date, 'jS M y - g:i A');
									?><br>
										<span class="note">Test ended at : </span>
									<?php
									$date = date_create($test_details->ended_on);
									echo  date_format($date, 'jS M y - g:i A');
									?>
								@else
								<form role="form" action="/index.php/{!! $test_details->test_id !!}/admin/updatetest" id="edittest" name="edittest"  method="post">
									<input type="hidden" value="1" name="started_on">
									<input type="hidden" value="1" name="status">
									<button type="submit" class="btn btn1" name="action_page" value="3">Start test</button>
									</form>
								@endif
							</center>


						</div>
					</div>
				</div>

				<div class="tab-pane tab-pane1 fade in" id="test_profile">
					<div class="list-group">
						<div class="list-group-item">

							<form role="form" action="/index.php/{!! $test_details->test_id !!}/admin/updatetest" id="edittest" name="edittest"  method="post">

							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="title">Test Title</label>
										<input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{!! $test_details->title !!}">
									</div>
								</div>
								<div class="col-md-3"></div>
							</div>

							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="pwd">Test User: </label>
										<input type="email" name="test_user" class="form-control" id="pwd" placeholder="Email" value="{!! $test_details->test_user !!}">
									</div>
								</div>
								<div class="col-md-3"></div>
							</div>

								<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="pwd">Test Password : </label>
										<input type="password" class="form-control" name="test_password" placeholder="Password" value="{!! $test_details->test_password !!}">
									</div>
								</div>
								<div class="col-md-3"></div>
							</div>

								<div class="row">

										<div class="col-md-3"></div>
										<div class="col-md-3">
											@if($test_details->is_question_random)
												<input type="checkbox" name="is_question_random" value="1" checked>
											@else
												<input type="checkbox" name="is_question_random" value="1">
											@endif
												<label>Randomize question order</label>
										</div>
										<div class="col-md-3">
											@if($test_details->is_option_random)
												<input type="checkbox" name="is_option_random" value="1" checked>
											@else
												<input type="checkbox" name="is_option_random" value="1">
											@endif <label>
													Randomize option order</label>
										</div>
										<div class="col-md-3"></div>

								</div>

								<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="title">Instructions </label>
										<textarea class="form-control editable" name="terms_conditions">
									{!! $test_details->terms_conditions !!}
									</textarea>
									</div>
								</div>
								<div class="col-md-3"></div>
							</div>

							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3">
									<div class="form-group has-feedback">
										<label class="control-label col-md-7" for="duration">Duration (Mins) </label>
										<div class="col-md-5 zeropadding">
											<input type="number" min="1" name="duration" class="form-control" step="1" id="duration" value="{!! $test_details->duration !!}">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label col-xs-6" for="duration">(-) ve marks</label>
										<div class="col-xs-6">
											@if($test_details->duration)
												<input type="radio" name="is_negative" value="0"> No
												<input type="radio" name="is_negative" value="1" checked> Yes
											@else
												<input type="radio" name="is_negative" value="0" checked> No
												<input type="radio" name="is_negative" value="1"> Yes
											@endif
										</div>
									</div>

								</div>
								<div class="col-md-3"></div>
							</div><br>

							<div class="row">
								<center>
									@if(($test_details->status!=1)&&($test_details->status!=2))
									<button type="submit" class="btn btn1" name="action_page" value="3">Save</button>
									@else
										<span class="note">* Test started can't edit now</span>
									@endif
								</center>
							</div>

							</form>


						</div>
					</div>
				</div>

				<div class="tab-pane tab-pane1 fade in" id="test_question">
					<div class="list-group">
						<div class="list-group-item">

							<div class="row">

								<div class="col-md-3"></div>
										<div class="col-md-3 text_right">
											<label for="title">Question Paper Id : </label>
										</div>
										<div class="col-md-3">
											<span>{!! $qp_details->qp_id !!}</span>
										</div>
								<div class="col-md-3"></div>


							</div>

							<div class="row">

								<div class="col-md-3"></div>
										<div class="col-md-3 text_right">
											<label for="title">Question Paper Title : </label>
										</div>
										<div class="col-md-3">
											<span>{!! $qp_details->title !!}</span>
										</div>
								<div class="col-md-3"></div>


							</div>

							<div class="row">

								<div class="col-md-3"></div>
										<div class="col-md-3 text_right">
											<label for="title">Status : </label>
										</div>
										<div class="col-md-3">
											@if($qp_details->status)
											<span>Active</span>
											@else
												<span>Inactive</span>
											@endif
										</div>
								<div class="col-md-3"></div>


							</div>

							<div class="row">
								<center>
									@if(($test_details->status!=1)&&($test_details->status!=2))
									<a href="/index.php/{!! $test_details->test_id !!}/admin/update_assigned_questionpaper" type="button" class="btn btn1">Change Question Paper</a>
									@endif
									<a href="/index.php/admin/view_question_paper/{!!  $qp_details->qp_id !!}" type="button" class="btn btn2">View Question Paper</a>
								</center>
							</div>

						</div>
					</div>
				</div>


				<div class="tab-pane tab-pane1 fade in" id="test_report">
					<div class="list-group">
						<div class="list-group-item">
							<p>Download <a href="/632746/admin/key" style="color:blue">answer key</a></p>
							<div class="row">
								<h3 class="h31">Scoresheet</h3>
								<table class="table">
									<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Marks</th>
										<th>Started on</th>
										<th>Ended on</th>
										<th>Duration (hrs)</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>1</td>
										<td>Sathish</td>
										<td>50</td>
										<td>29th dec 2015 , 11:00 pm</td>
										<td>29th dec 2015 , 12:00 pm</td>
										<td>01:00</td>
									</tr>
									<tr>
										<td>2</td>
										<td>Kumar</td>
										<td>50</td>
										<td>29th dec 2015 , 11:00 pm</td>
										<td>29th dec 2015 , 12:00 pm</td>
										<td>01:00</td>
									</tr>
									<tr>
										<td>3</td>
										<td>Raju</td>
										<td>50</td>
										<td>29th dec 2015 , 11:00 pm</td>
										<td>29th dec 2015 , 12:00 pm</td>
										<td>01:00</td>
									</tr>
									<tr>
										<td>4</td>
										<td>Jakku</td>
										<td>50</td>
										<td>29th dec 2015 , 11:00 pm</td>
										<td>29th dec 2015 , 12:00 pm</td>
										<td>01:00</td>
									</tr>

									</tbody>
								</table>
							</div>
							<hr/>
							<div class="row">
								<h3 class="h31">Question grid</h3>
								<table class="table">
									<thead>
									<th>#</th>
									<th>Name</th>
									<th>1</th>
									<th>2</th>
									<th>3</th>
									<th>4</th>
									<th>5</th>
									<th>6</th>
									<th>7</th>
									<th>8</th>
									<th>9</th>
									<th>10</th>
									<th>Total</th>
									</thead>
									<tbody>
									<tr>
										<td>1</td>
										<td>Sathish</td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-times"></i></td>
										<td><i class="fa fa-times"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-times"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td>2/10</td>
									</tr>
									<tr>
										<td>2</td>
										<td>Kumar</td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-times"></i></td>
										<td><i class="fa fa-times"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-times"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td>2/10</td>
									</tr>
									<tr>
										<td>3</td>
										<td>Raju</td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-times"></i></td>
										<td><i class="fa fa-times"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-times"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td>2/10</td>
									</tr>
									<tr>
										<td>4</td>
										<td>Jakku</td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-times"></i></td>
										<td><i class="fa fa-times"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td><i class="fa fa-times"></i></td>
										<td><i class="fa fa-check"></i></td>
										<td>2/10</td>
									</tr>
									</tbody>
								</table>

							</div>
						</div>
					</div>
				</div>

			</div>
		<!-- Tab panes -->
           </span>
</div>

@stop