@extends('layouts.page')
@section('content')
<div class="homecontainer container">
<div class="container">




	<div class="col-xs-12">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="panel-group panel-group1" >
						<div class="panel panel-default">
							<div class="panel-heading panelcolor1">
								<h4 class="panel-title">
									 Question Paper Details
								</h4>
							</div>
							<div  class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="row">
										<div class="col-xs-12">
											<a href="/index.php/{!!$details->qp_id !!}/admin/edit_questionpaper" class="href1"><i class="fa fa-pencil-square-o"></i> Edit Question Paper</a>
										</div>
									</div>
									<div class="well">

										<div class="row">
											<div class="col-xs-6">
												<label class="pull-right">Id : </label>
											</div>
											<div class="col-xs-6">
												{!! $details->qp_id !!}
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<label class="pull-right">Title : </label>
											</div>
											<div class="col-xs-6">
												{!! $details->title !!}
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<label class="pull-right">No.of.Qns : </label>
											</div>
											<div class="col-xs-6">
												{!! $details->number_of_questions !!}
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<label class="pull-right">Total marks : </label>
											</div>
											<div class="col-xs-6">
												{!! $details->total_marks !!}
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<label class="pull-right">Duration (mins) : </label>
											</div>
											<div class="col-xs-6">
												{!! $details->duration !!}
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-xs-12 ">
											<!--http://stackoverflow.com/questions/18325779/bootstrap-3-collapse-show-state-with-chevron-icon-->
											<div class="panel-group" id="accordion">
												@foreach($section as $key => $value)
													<div class="panel panel-default">
														<div class="panel-heading panelcolor2">
															<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#{!! 'section'.$key !!}">
																<h4 class="panel-title">Section {!! $value -> section_value !!} details</h4>
															</a>
														</div>
														<div id="{!! 'section'.$key !!}" class="panel-collapse collapse">
															<div class="panel-body">
																<div class="row">
																	<div class="col-xs-6">
																		<a href="/index.php/{!!$value->qp_id !!}/admin/edit_section/{!!$value->section_id !!}" class="href1"><i class="fa fa-pencil-square-o"></i> Edit </a>
																	</div>
																	<div class="col-xs-6">
																		<a data-toggle="modal" data-target="#section_delete"  class="href1 delete_section_href" id="{!!$value->section_id !!}"><i class="fa fa-trash-o"></i> Delete </a>
																	</div>
																</div>
																<hr>
																<div class="form-group row">
																	<label class="col-xs-6">Section Type :</label>
																<span class="col-xs-6">
																	@if ($value -> section_type == 1)
																		Options / Fill blanks
																	@else
																		Comprehension / Based on paragraph
																	@endif
																</span>
																</div>
																<div class="form-group row">
																	<label class="col-md-6">Subject :</label>
																	<span class="col-md-6">{!! $value -> section_subject !!}</span>
																</div>
																<div class="form-group row">
																	<label class="col-md-6">Chapter :</label>
																	<span class="col-md-6">{!! $value -> section_chapter !!}</span>
																</div>
																<div class="form-group row">
																	<label class="col-md-6">No.of.Questions :</label>
																	<span class="col-md-6">{!! $value -> number_of_questions_section !!}</span>
																</div>
																<div class="form-group row">
																	<label class="col-md-6">Marks/Question :</label>
																	<span class="col-md-6">{!! $value -> marks_per_question !!}</span>
																</div>
																<div class="form-group row">
																	<label class="col-md-6">Total Marks:</label>
																	<span class="col-md-6">{!! $value -> section_total !!}</span>
																</div>
															</div>
														</div>
													</div>
												@endforeach
											</div>
										</div>
									</div>
									<div class="row">
										<center>
											<?php $remaining= $details->number_of_questions ?>
											@foreach($section as $key => $value)
												<?php  $remaining = $remaining - $value -> number_of_questions_section  ?>
											@endforeach
												@if($remaining != 0)
											<a href="/index.php/{!!$details->qp_id !!}/admin/set_section" class="btn btn2 href2">Add New Section</a>
												@endif
											@if($section)
												<a href="/index.php/{!!$details->qp_id !!}/admin/set_questions/1/1" class="btn btn1 href1">View / Edit Question Paper</a>
											@else
												<a href="/index.php/{!!$details->qp_id !!}/admin/edit_questionpaper" class="btn btn-default" >Cancel</a>
											@endif

										</center>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
		</div>
	</div>

</div>



</div>
</div>




</div>
</div>

	<!-- Modal -->
	<div class="modal fade" id="model_cancel" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">

				<div class="modal-body">
					<center>
					<h4>Are you sure to cancel and proceed to question paper?</h4>
					<button type="button" class="btn btn1" data-dismiss="modal">Yes</button>
					<button type="button" class="btn btn2" data-dismiss="modal">No</button>
					</center>
				</div>

			</div>

		</div>
	</div>

<div class="modal fade" id="section_delete" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">

			<div class="modal-body">
				<center>
					<h4>Are you sure to delete the section?</h4>
					<form action="/index.php/admin/delete_section" method="post">
						<input type="hidden" name="qp_id" value="{!! $details->qp_id !!}">
						<input type="hidden" name="section_id" id="section_id" class="section_id">
						<button type="submit" class="btn btn1" >Yes</button>
						<button type="button" class="btn btn2" data-dismiss="modal" onclick="return false;">No</button>
					</form>
				</center>
			</div>

		</div>

	</div>
</div>


@stop