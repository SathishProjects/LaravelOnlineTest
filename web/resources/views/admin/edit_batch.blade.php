@extends('layouts.page')
@section('content')
<div class="homecontainer container">
<div class="container">

<form role="form" action="/index.php/college/update_batch" id="createbatch" name="createbatch"  method="post">
	<div class="col-xs-12">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="panel-group panel-group1" id="accordion">
						<div class="panel panel-default">

							<div id="collapseOne" class="panel-collapse collapse in">
								<div class="panel-body">
								<h2 class="text-center text-danger">UPDATE BATCH</h2>
									

									<div class="panel panel-default">
  										<div class="panel-body">
  										<h4 class="text-danger">BATCH DETAILS</h4>
  											<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												
												<input type="hidden" name="batch_id" value="{{ $details->batch_id }}" />
												<label>Degree</label>
												<select class="form-control multiselect ug_degree" name="batch_degree">
													<option selected disabled value="">Select Degree</option>
													
													<optgroup label="UG">
													@foreach($degree_list->ug as $dkey1 => $dval1)
														@if($dval1->id > 0)
														
														
														@if( $details->batch_degree  == $dval1->id) 
															<option value="{{ $dval1->id }}" selected>{{$dval1->name}}</option>
														@else 
															<option value="{{ $dval1->id }}">{{$dval1->name}}</option>
														@endif 

														@endif
													@endforeach
													</optgroup>

													<optgroup label="PG">
													@foreach($degree_list->pg as $dkey2 => $dval2)
														@if($dval2->id > 0)
														@if( $details->batch_degree  == $dval2->id) 
															<option value="{{ $dval2->id }}" selected>{{$dval2->name}}</option>
														@else 
															<option value="{{ $dval2->id }}">{{$dval2->name}}</option>
														@endif 
														@endif
													@endforeach
													</optgroup>

												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Branch</label>
												<select class="form-control multiselect ug_branch" name="batch_branch">
													<option selected disabled value="">Select Branch</option>
													@foreach($selected_degree_branch as $sdl_k => $sdl_v)
														@if( $details->batch_branch == $sdl_k)
														<option value="{{ $sdl_k }}" selected>{{$sdl_v}}</option>
														@else
														<option value="{{ $sdl_k }}">{{$sdl_v}}</option>
														@endif
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												
												<?php $now = date("Y"); $date1 = $now-4;$date2 = $now+1; ?>    
												<?php $years = range($date2,$date1) ?>
												<label>Year of joining</label>
												<select class="form-control multiselect" name="batch_year">
													<option selected disabled value="">Select Year of joining</option>
													@foreach($years as $key)
													@if( $details->batch_year  == $key)
													<option value="{{$key}}" selected>{{$key}}</option>
													@else
													<option value="{{$key}}">{{$key}}</option>
													@endif
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												
												<?php $now = date("Y"); $date1 = $now-4;$date2 = $now+4; ?>    
												<?php $years = range($date2,$date1) ?>
												<label>Year of leaving</label>
												<select class="form-control multiselect" name="batch_year">
													<option selected disabled value="">Select Year of leaving</option>
													@foreach($years as $key)
													@if( $details->batch_year_to  == $key)
													<option value="{{$key}}" selected>{{$key}}</option>
													@else
													<option value="{{$key}}">{{$key}}</option>
													@endif
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
											<label>Class Strength</label>
												<input type="number" class="form-control" placeholder="Class Strength" name="student_count" min="1" value="{{ $details->student_count }}" /></div>
										</div>

									</div>
  										</div>
									</div>

									<div class="panel panel-default">
  										<div class="panel-body">	
  										<h4 class="text-danger">HOD DETAILS</h4>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Name</label>
												<input type="text" class="form-control" placeholder="HOD Name" name="hod_name" value="{{ $details->hod_name }}"/>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>E-Mail</label>
												<input type="text" class="form-control" placeholder="HOD Email" name="hod_email" value="{{ $details->hod_email }}"/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Mobile</label>
												<input type="text" class="form-control" placeholder="HOD Mobile" name="hod_mobile" value="{{ $details->hod_mobile }}"/>
											</div>
										</div>

									</div></div></div>

									<div class="panel panel-default">
  										<div class="panel-body">

  										<h4 class="text-danger">CLASS TEACHER DETAILS</h4>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Name</label>
												<input type="text" class="form-control" placeholder="Class Teacher Name" name="class_teacher_name"  value="{{ $details->class_teacher_name }}"/>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>E-Mail</label>
												<input type="text" class="form-control" placeholder="Class Teacher Email" name="class_teacher_email"  value="{{ $details->class_teacher_email }}"/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Mobile</label>
												<input type="text" class="form-control" placeholder="Class Teacher Mobile" name="class_teacher_mobile"  value="{{ $details->class_teacher_mobile }}"/>
											</div>
										</div>

									</div></div></div>

									<div class="panel panel-default">
  										<div class="panel-body">

  										<h4 class="text-danger">CLASS LEADER DETAILS</h4>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Name</label>
												<input type="text" class="form-control" placeholder="Class Leader Name" name="rep_name"  value="{{ $details->rep_name }}"/>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>E-Mail</label>
												<input type="text" class="form-control" placeholder="Class Leader Email"  name="rep_email"  value="{{ $details->rep_email }}"/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Mobile</label>
												<input type="text" class="form-control" placeholder="Class Leader Mobile" name="rep_mobile"  value="{{ $details->rep_mobile }}"/>
											</div>
										</div>

									</div></div></div>

									<p>
										<center>
										<button class="btn btn1 nextBtn" type="submit" >UPDATE</button>
									</center>
									</p>
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