@extends('layouts.page')
@section('content')
<div class="homecontainer container">
<div class="container">

<form role="form" action="updatetest" id="updatetest" name="updatetest"  method="post">
	<div class="col-xs-12">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="panel-group panel-group1" id="accordion">
						<div class="panel panel-default">

							<div id="collapseOne" class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>TEST ID : </label>{!! $details->test_id !!}
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>TEST NAME : </label>{!! $details->title !!}
											</div>
										</div>
									</div>

									

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Question Paper Id </label> <span class="pull-right"><input type="checkbox" class="change_question_id"/> Change Question paper</span>
													<div class="input-group">
														<input type="text" name="qp_id" class="form-control qpaper_id" placeholder="Question Paper Id" value="{!! $details->qp_id !!}">
                    			   						<span class="input-group-btn">
                        								<button type="button" name="check_btn" class="btn btn2 check_btn" id="check_btn" disabled>Get Details</button>
                    			   						</span>
													</div>
												<div class="progress progress1" hidden>
													<div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar"
														 aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Loading Please wait ...</div>
												</div>

											</div>
										</div>
										<div class="col-md-6">

										</div>
									</div>

									<div class="row error_details_container" hidden>
										<div class="col-md-12">
											<span class="fontsize2">Requested Question Paper not active (or) Not found ...</span>
										</div>
									</div>
									<div class="question_details_container">

									<span class="help-block">( Choosen: <span class="qn_title">{!! $details->qp_title !!}</span> created on - 

									<span class="qn_created">
									 <?php
								 $date = date_create($details->qp_created );
								 echo date_format($date, 'm/d/Y, g:i:s A');
								 ?>
									</span>  )</span>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-xs-7" for="number_of_questions">No.of.Questions <span class="note">*</span>  </label>
												<div class="col-xs-5">
													<input type="number" min="1" name="number_of_questions" value="{!! $details->number_of_questions !!}" class="form-control number_of_questions" id="number_of_questions" placeholder="0" readonly>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-xs-7" for="total_marks">Total marks <span class="note">*</span>  </label>
												<div class="col-xs-5">
													<input type="number" min="1" name="total_marks" value="{!! $details->total_marks !!}" class="form-control total_marks" id="total_marks" placeholder="0" readonly>
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-xs-7" for="duration">Duration (Mins) </label>
												<div class="col-xs-5">
													<input type="number" min="1" name="duration" value="{!! $details->duration !!}" class="form-control duration" step="1" id="duration" placeholder="0">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-xs-7" for="duration"> Negative marks </label>
												<div class="col-xs-5">
													@if($details->duration)
													<input type="radio" name="is_negative" class="is_negative" value="0"> No
													<input type="radio" name="is_negative" class="is_negative" value="1" checked> Yes
													@else
														<input type="radio" name="is_negative" class="is_negative" value="0" checked> No
														<input type="radio" name="is_negative" class="is_negative" value="1"> Yes
													@endif
												</div>
											</div>

										</div>
									</div>
									<br>
									</div>

									<div class="row note_div">
										<div class="col-xs-12">
										<span class="note"> Note:  fields with * are readonly not editable</span>
										</div>
									</div>

									<center>

										<button class="btn btn1 submit_btn" type="submit">Update & Proceed</button>
										<button class="btn btn2 " type="button" onclick=" location.reload();">Reset</button>
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