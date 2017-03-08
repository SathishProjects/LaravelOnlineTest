@extends('layouts.page')
@section('content')
	<style>
		@media only screen and (min-width: 768px){
			#header .head-right {
				margin-top: 25px !important;
				margin-right: -117px !important;
			}}
	</style>
	<div class="homecontainer container" xmlns="http://www.w3.org/1999/html">
		<div class="container">

			<div class="row">

					<ol class = "breadcrumb margintop1 zeromarginbottom">
						<li><a href="/index.php/admin/questionpaper/active">Home</a></li>
						<li><a href="#" onclick="window.history.go(-1); return false;">Back</a></li>
						<li class = "active">Question Paper</li>
					</ol>

			</div>

			<div class="row">

				<div class="col-md-12">

				<div class="panel-group panel-group1 zeropaddingtop" >
					<div class="panel">
						<div  class="panel-collapse collapse in">
							<div class="panel-body">


								<div class="row">
									<div class="col-xs-12">
										<center>
											<label>{!! $qp_details->title !!}</label>
										</center>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<label>Duration : </label> {!! $qp_details->duration !!} mins</br>
									</div>

									<div class="col-md-6">
										<div class="pull-right">
											<label>Maximum Marks : </label> {!! $qp_details->total_marks !!}</br>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-xs-12">
										<center>
											<label>General Instructions  </label>
										</center>
										{!! $qp_details->terms_conditions !!}
									</div>
								</div>
								<br>
								<?php
								$alphabet = range('A', 'Z');
								?>
								@foreach($subject as $key => $value)
								<div class = "panel panel-default">
									<div class = "panel-body">
										<div class="row">
											<div class="col-xs-12">
												<center>
													<label>Section - {!! $alphabet[$key] !!}</label>
													<span>( {!! $value !!} )</span><br>
												</center>

												@foreach($section_details as $skey => $svalue)
													@if( $svalue->section_subject ==$value)

													@if($svalue->terms_conditions)
													<div class="row">
													<div class="col-xs-12 section_question">
														<label>Directions  </label>
														{!! $svalue->terms_conditions !!}
													</div>
													</div>@endif

													@if($svalue->section_question)
															<div class="col-xs-12 section_question">
																<p><span class="question_text">{!! $svalue->section_question !!}</span></p>
																@if($svalue->question_image)
																<div class="question_image">
																	<center>
																		<img src="{!! $svalue->question_image !!}">
																	</center>
																</div>
																@endif
															</div>
													@endif

														@foreach($question_details as $qkey => $qvalue)

															@if( $qvalue->subject_id ==$value)

															<div class="row all_question_container">
															<div class="col-xs-12">
																@if($qvalue->answer_type == 1)
																<div class="row question_container">
																		<hr>
																		<div class="col-xs-12 question_body">

																			<p>
																				<span class="question_id">Q.{!! $qkey+1 !!}</span>
																				<span class="question_text">{!! $qvalue->question_text !!}</span>
																			</p>
																			@if($qvalue->question_image)
																			<div class="question_image">
																				<center>
																					<img src="{!! $qvalue->question_image !!}">
																				</center>
																			</div>
																			@endif

																			@foreach($option_details as $okey => $ovalue)
																				@if($ovalue->qpq_id == $qvalue->qpq_id)
																					<p class="option">
																						<span class="option_type">
																						@if($ovalue->is_correct == 1)
																						<input type="checkbox" checked/>
																						@else
																								<input type="checkbox"/>
																						@endif
																						</span>
																						<span class="option_text">
																							{!! $ovalue->answer_text !!}
																						</span>
																					</p>
																				@endif
																			@endforeach

																		</div>
																		<hr>
																	</div>
																@elseif($qvalue->answer_type == 2)
																<div class="row question_container">
																		<hr>
																		<div class="col-xs-12 question_body">


																			<p>
																				<span class="question_id">Q.{!! $qkey+1 !!}</span>
																				<span class="question_text">{!! $qvalue->question_text !!}</span>
																			</p>

																			@if($qvalue->question_image)
																				<div class="question_image">
																					<center>
																						<img src="{!! $qvalue->question_image !!}">
																					</center>
																				</div>
																			@endif

																			@foreach($option_details as $o2key => $o2value)
																				@if($o2value->qpq_id == $qvalue->qpq_id)
																					<p class="option">
																						<span class="option_type">
																						@if($o2value->is_correct == 1)
																								<input type="radio" name="{!! $o2value->qpq_id !!}" checked/>
																							@else
																								<input type="radio" name="{!! $o2value->qpq_id !!}"/>
																							@endif
																						</span>
																						<span class="option_text">
																							{!! $o2value->answer_text !!}
																						</span>
																					</p>
																				@endif
																			@endforeach


																		</div>
																		<hr>
																	</div>
																@elseif($qvalue->answer_type == 3)
																<div class="row question_container">
																	<hr>
																	<div class="col-xs-12 question_body">

																		<p>
																			<span class="question_id">Q.{!! $qkey+1 !!}</span>
																			<span class="question_text">{!! $qvalue->question_text !!}</span>
																		</p>

																		@if($qvalue->question_image)
																			<div class="question_image">
																				<center>
																					<img src="{!! $qvalue->question_image !!}">
																				</center>
																			</div>
																		@endif

																		@foreach($option_details as $o3key => $o3value)
																			@if($o3value->qpq_id == $qvalue->qpq_id)
																				<p class="option">
																						<span class="option_type">
																						@if($o3value->answer_text == 1)
																								<input type="radio" name="{!! $o3value->qpq_id !!}" checked/> True
																								<input type="radio" name="{!! $o3value->qpq_id !!}"/> False
																							@else
																								<input type="radio" name="{!! $o3value->qpq_id !!}"/> True
																								<input type="radio" name="{!! $o3value->qpq_id !!}" checked/> False
																							@endif
																						</span>
																				</p>
																			@endif
																		@endforeach


																	</div>
																	<hr>
																</div>
																@elseif($qvalue->answer_type == 4)
																<div class="row question_container">
																	<hr>
																	<div class="col-xs-12 question_body">


																		<p>
																			<span class="question_id">Q.{!! $qkey+1 !!}</span>
																			<span class="question_text">{!! $qvalue->question_text !!}</span>
																		</p>

																		@if($qvalue->question_image)
																			<div class="question_image">
																				<center>
																					<img src="{!! $qvalue->question_image !!}">
																				</center>
																			</div>
																		@endif


																		@foreach($option_details as $o4key => $o4value)
																			@if($o4value->qpq_id == $qvalue->qpq_id)
																				<p class="option">
																						<span class="option_type">
																								<span class="option_type"><input type="checkbox" checked disabled></span>
																						</span>
																						<span class="option_text">
																							{!! $o4value->answer_text !!}
																						</span>
																				</p>
																			@endif
																		@endforeach


																	</div>
																	<hr>
																</div>
																@endif

															</div>
														</div>
															@endif

														@endforeach

													@endif
												@endforeach

											</div>
										</div>
									</div>
								</div>
								@endforeach


							</div>
						</div>
					</div>
				</div>

				</div>
			</div>

		</div>
	</div>
@stop