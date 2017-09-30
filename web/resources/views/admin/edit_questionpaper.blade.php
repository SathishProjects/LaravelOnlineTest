@extends('layouts.page')
@section('content')
<div class="homecontainer container">
<div class="container">

<form role="form" action="/index.php/{!! $details->qp_id !!}/college/update_questionpaper" id="createquestion_paper" name="createquestion_paper" method="post">
	<div class="col-xs-12">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="panel-group panel-group1" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading  panelcolor1">
								<h4 class="panel-title">
                            <span class="glyphicon glyphicon-file">
                            </span> Question Paper Details
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="title">Title:</label>
												<input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{!! $details->title !!}">
											</div>
											<div class="form-group">
												<label for="title">Instructions:</label>
												<textarea class="form-control editable" name="terms_conditions" placeholder="Instructions" id="Instructions" rows="5">{!! $details->terms_conditions !!}</textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-xs-8" for="number_of_questions">No.of.Questions : </label>
												<div class="col-xs-4">
													<input type="number" name="number_of_questions" class="form-control" id="number_of_questions" placeholder="0"  value="{!! $details->number_of_questions !!}">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-xs-8" for="total_marks">Total marks : </label>
												<div class="col-xs-4">
													<input type="number" name="total_marks" class="form-control" id="total_marks" placeholder="0"  value="{!! $details->total_marks !!}">
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-xs-7" for="duration">Duration (Mins): </label>
												<div class="col-xs-5">
													<input type="number" name="duration" class="form-control" id="duration" placeholder="0" value="{!! $details->duration !!}">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-xs-7" for="duration"> Negative marks </label>
												<div class="col-xs-5">
													@if($details->is_negative)
													<input type="radio" name="is_negative" value="0"> No
													<input type="radio" name="is_negative" value="1" checked> Yes
													@else
														<input type="radio" name="is_negative" value="0" checked> No
														<input type="radio" name="is_negative" value="1"> Yes
													@endif
												</div>
											</div>

										</div>
									</div>
									<br>


									<br>
									<center>

										<button class="btn btn2 nextBtn" type="submit" >Next</button>
									</center>

								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="col-md-2"></div>
			</div>



		</div>
	</div>
</form>

</div>
</div>
</div>
</div>
</div>

@stop